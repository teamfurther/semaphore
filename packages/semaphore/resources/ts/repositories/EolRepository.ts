import ApiService from "../services/ApiService";
import {EolType} from "../types/eol/EolType";
import {EolColor} from "../enums/EolColor";

export default class EolRepository {
    private apiService: ApiService = ApiService.getInstance();
    private static instance: EolRepository | null = null;

    private constructor() {}

    public static getInstance(): EolRepository {
        if (this.instance === null) {
            this.instance = new EolRepository();
        }

        return this.instance;
    }

    public getEol(metric: string, start: number, end: number, instance: string): Promise<EolType[]> {
        return new Promise<EolType[]>((resolve, reject) => {
            const url = `data/eol?metric=${metric}&instance=${instance}&start=${start}&end=${end}`;
            this.apiService.get(url)
                .then(response => {
                    resolve(response.data.map((eol: any) => {
                        if (eol) {
                            const { product, version, latest, activeSupport, securitySupport } = eol;
                            const color = activeSupport ? EolColor.GREEN : (securitySupport ? EolColor.YELLOW : EolColor.RED);
                            const currentVersionString = `${version.major}.${version.minor}.${version.patch}`;
                            const latestVersionString = `${latest.major}.${latest.minor}.${latest.patch}`;

                            return {
                                name: product,
                                version: currentVersionString,
                                color: color,
                                isLatest: currentVersionString === latestVersionString,
                            } as EolType;
                        }

                        return null;
                    }).filter((eol: any) => eol));
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

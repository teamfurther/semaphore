import ApiService from "../services/ApiService";
import {EolType} from "../types/eol/EolType";

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

    public getEol(metric: string, start: number, end: number): Promise<EolType[]> {
        return new Promise<EolType[]>((resolve, reject) => {
            const url = `data/eol?metric=${metric}&start=${start}&end=${end}`;
            this.apiService.get(url)
                .then(response => {
                    resolve(response.data.map((eol: any) => {
                        const { name, version, color } = eol;

                        return {
                            name,
                            version,
                            color
                        } as EolType;
                    }));
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

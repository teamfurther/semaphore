import ApiService from "../services/ApiService";
import { ListType } from "../types/trend/ListType";


export default class TrendRepository {
    private apiService: ApiService = ApiService.getInstance();
    private static instance: TrendRepository | null = null;

    private constructor() {
    }

    public static getInstance(): TrendRepository {
        if (this.instance === null) {
            this.instance = new TrendRepository();
        }

        return this.instance;
    }

    public index(metric: string, instance: string, start: number, end: number): Promise<ListType> {
        return new Promise<ListType>((resolve, reject) => {
            const url = `data/trend?metric=${metric}&instance=${instance}&start=${start}&end=${end}`;
            this.apiService.get(url)
                .then(response => {
                    let result: ListType = {
                        'totals': response.data.totals,
                        'values': response.data.values,
                    };

                    resolve(result);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

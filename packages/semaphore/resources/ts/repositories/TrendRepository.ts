import ApiService from "../services/ApiService";
import { TrendType } from "../types/trend/TrendType";
import { ValueType } from "../types/trend/ValueType";

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

    public getTrend(metric: string, start: number, end: number, instance: string): Promise<TrendType[]> {
        return new Promise<TrendType[]>((resolve, reject) => {
            const url = `data/trend?metric=${metric}&instance=${instance}&start=${start}&end=${end}`;
            this.apiService.get(url)
                .then(response => {
                    const result: TrendType[] = [];

                    response.data.forEach((trend: any) => {
                        const { pid, processName, values } = trend;
                        const trendValues: ValueType[] = values;

                        result.push({ pid, processName, values: trendValues })
                    });

                    resolve(result);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

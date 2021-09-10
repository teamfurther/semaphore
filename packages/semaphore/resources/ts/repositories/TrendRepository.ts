import Trend from "../models/trend/Trend";
import ApiService from "../services/ApiService";
import Value from "../models/trend/Value";

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

    public getTrend(metric: string, start: number, end: number): Promise<Trend[]> {
        return new Promise<Trend[]>((resolve, reject) => {
            const url = `data/trend?metric=${metric}&start=${start}&end=${end}`;
            this.apiService.get(url)
                .then(response => {
                    const result: Trend[] = [];

                    response.forEach((trend: any) => {
                        const { pid, processName, values } = trend;
                        const trendValues: Value[] = values;

                        result.push(new Trend(pid, processName, trendValues))
                    });

                    resolve(result);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

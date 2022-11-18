import ApiService from "../services/ApiService";
import {GaugeType} from "../types/gauge/GaugeType";
import GaugeService from "../services/GaugeService";
import CheckService from "../services/CheckService";

export default class GaugeRepository {
    private apiService: ApiService = ApiService.getInstance();
    private static instance: GaugeRepository | null = null;
    private gaugeService: GaugeService = GaugeService.getInstance();
    private checkService: CheckService = CheckService.getInstance();

    private constructor() {}

    public static getInstance(): GaugeRepository {
        if (this.instance === null) {
            this.instance = new GaugeRepository();
        }

        return this.instance;
    }

    public getGauge(metric: string, instance: string): Promise<GaugeType[]> {
        return new Promise<GaugeType[]>((resolve, reject) => {
            const url = `data/gauge?metric=${metric}&instance=${instance}`;
            this.apiService.get(url)
                .then(response => {
                    this.checkService.getCheckByProjectAndName(instance, metric)
                        .then(check => {
                            console.log('check', instance, metric, check);
                            resolve(response.data.map((gauge: any) => {
                                return {
                                    color: this.gaugeService.getColorByValue(gauge.value, check?.levels ?? null),
                                    name: gauge.name,
                                    value: gauge.value * 100,
                                } as GaugeType;
                            }));
                        });

                })
                .catch(error => reject(error));
        });
    }
}

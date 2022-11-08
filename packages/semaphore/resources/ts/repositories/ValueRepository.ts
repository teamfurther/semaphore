import ApiService from "../services/ApiService";
import {ValueType} from "../types/value/ValueType";

export default class ValueRepository {
    private apiService: ApiService = ApiService.getInstance();
    private static instance: ValueRepository | null = null;

    private constructor() {
    }

    public static getInstance(): ValueRepository {
        if (this.instance === null) {
            this.instance = new ValueRepository();
        }

        return this.instance;
    }

    public getValue(metric: string, instance: string): Promise<ValueType> {
        return new Promise<ValueType>((resolve, reject) => {
            const url = `data/value?metric=${metric}&instance=${instance}`;
            this.apiService.get(url)
                .then(response => {
                    const { value } = response.data;

                    resolve({
                        value: value,
                    } as ValueType);
                })
                .catch(error => reject(error));
        });
    }
}

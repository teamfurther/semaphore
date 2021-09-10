import axios, {AxiosResponse} from "axios";
import store from "../store";

export default class ApiService {
    private static instance: ApiService | null = null;

    private constructor() {
    }

    public static getInstance(): ApiService {
        if (this.instance === null) {
            this.instance = new ApiService();
        }

        return this.instance;
    }

    public get(slug: string): Promise<any> {
        return new Promise<any>((resolve, reject) => {
            axios.get(store.state.appUrl + '/api/' + slug)
                .then(response => resolve(response.data))
                .catch(error => {
                    console.error(error);
                    reject(error);
                });
        });
    }
}

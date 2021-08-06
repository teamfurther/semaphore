import axios, {AxiosResponse} from "axios";
import apiConfig from "../config/apiConfig";

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

    public get(slug: string): Promise<AxiosResponse> {
        console.log(apiConfig.apiUrl);
        return new Promise<AxiosResponse>((resolve, reject) => {
            axios.get(apiConfig.apiUrl + slug)
                .then(response => resolve(response.data))
                .catch(error => {
                    console.error(error);
                    reject(error);
                });
        });
    }
}

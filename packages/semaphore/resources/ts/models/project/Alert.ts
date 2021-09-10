export default class Alert {
    public filter: string;
    public max: number;
    public min: number;
    public period: number;

    constructor(filter: string, max: number, min: number, period: number) {
        this.filter = filter;
        this.max = max;
        this.min = min;
        this.period = period;
    }
}

import Value from "./Value";

export default class Trend {
    public pid: number;
    public processName: string;
    public values: Value[];

    constructor(pid: number, processName: string, values: Value[]) {
        this.pid = pid;
        this.processName = processName;
        this.values = values;
    }
}

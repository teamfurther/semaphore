import Check from "./Check";

export default class Project {
    public instance: string;
    public url: string;
    public checks: Check[];

    constructor(instance: string, url: string, checks: Check[]) {
        this.instance = instance;
        this.url = url;
        this.checks = checks;
    }
}

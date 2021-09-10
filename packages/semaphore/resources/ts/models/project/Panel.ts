export default class Panel {
    public className: string;
    public order: number;
    public row: number;
    public title: string;
    public zone: string;

    constructor(className: string, order: number, row: number, title: string, zone: string) {
        this.className = className;
        this.order = order;
        this.row = row;
        this.title = title;
        this.zone = zone;
    }
}

import Alert from "./Alert";
import Panel from "./Panel";

export default class Check {
    public id: string;
    public alerts: Alert[];
    public metric: string;
    public panel: Panel;
    public widget: string;

    constructor(id: string, alerts: Alert[], metric: string, panel: Panel, widget: string) {
        this.id = id;
        this.alerts = alerts;
        this.metric = metric;
        this.panel = panel;
        this.widget = widget;
    }
}

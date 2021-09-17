import { AlertType } from "./AlertType";
import { PanelType } from "./PanelType";

export type CheckType = {
    id: string;
    alerts: AlertType[];
    metric: string;
    panel: PanelType;
    widget: string;
}

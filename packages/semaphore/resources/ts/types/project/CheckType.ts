import { AlertType } from "./AlertType";
import { PanelType } from "./PanelType";
import {LevelType} from "./LevelType";
import {WidgetType} from "./WidgetType";

export type CheckType = {
    id: string;
    alerts: AlertType[];
    metric: string;
    name: string;
    panel: PanelType;
    levels: LevelType;
    widget: Partial<WidgetType>;
}

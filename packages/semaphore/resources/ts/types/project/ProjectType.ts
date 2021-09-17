import { CheckType } from "./CheckType";

export type ProjectType = {
    instance: string;
    url: string;
    checks: CheckType[];
}

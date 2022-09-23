import { TotalType } from "./TotalType";
import { TrendType } from "./TrendType";

export type ListType = {
    totals: TotalType[]
    values: TrendType[],
}
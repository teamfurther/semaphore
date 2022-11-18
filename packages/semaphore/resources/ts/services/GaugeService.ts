import {LevelType} from "../types/project/LevelType";
import {Colors} from "../enums/colors";

export default class GaugeService {
    private static instance: GaugeService | null = null;

    private constructor() {
    }

    public static getInstance(): GaugeService {
        if (this.instance === null) {
            this.instance = new GaugeService();
        }

        return this.instance;
    }

    public getColorByValue(value: number, levels: LevelType | null): string {
        value = value * 100;

        if (!levels) {
            return Colors.GOOD;
        }

        if (value >= levels.critical) {
            return Colors.CRITICAL;
        }

        if (value >= levels.warning) {
            return Colors.WARNING;
        }

        return Colors.GOOD;
    }
}

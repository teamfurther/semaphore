export type ConfigType = {
    instance: string,
    name: string,
    url: string,
    checks: {
        id: string,
        alerts: {
            filter: string,
            max: number,
            period: number,
            type: string,
        }[],
        panel: {
            "class": string,
            "order": number,
            "row": number,
            "title": string,
            "zone": string,
        },
        metric: string,
        Widget: string,
    }[],
}
import ApiService from "../services/ApiService";
import { AlertType } from "../types/project/AlertType";
import { CheckType } from "../types/project/CheckType";
import { ProjectType } from "../types/project/ProjectType";

export default class ProjectRepository {
    private apiService: ApiService = ApiService.getInstance();
    private static instance: ProjectRepository | null = null;

    private constructor() {
    }

    public static getInstance(): ProjectRepository {
        if (this.instance === null) {
            this.instance = new ProjectRepository();
        }

        return this.instance;
    }

    public getProject(project: string): Promise<ProjectType> {
        return new Promise<ProjectType>((resolve, reject) => {
            const url = `projects/${project}`;

            this.apiService.get(url)
                .then(response => {
                    const checks: CheckType[] = [];

                    response.checks.forEach((check: any) => {
                        const { id, alerts, metric, name, panel, levels, widget } = check;
                        const alertsObj: AlertType[] = [];

                        if (alerts) {
                            alerts.forEach((alert: any) => {
                                const { channel, filter, max, min, period } = alert;

                                alertsObj.push({ channel, filter, max, min, period });
                            });
                        }

                        const panelObj = {
                            className: panel.className,
                            order: panel.order,
                            row: panel.row,
                            zone: panel.zone
                        };

                        checks.push({ id, alerts: alertsObj, metric, name, panel: panelObj, levels, widget });
                    });

                    const result: ProjectType = {instance: response.instance, url: response.url, checks };

                    resolve(result);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

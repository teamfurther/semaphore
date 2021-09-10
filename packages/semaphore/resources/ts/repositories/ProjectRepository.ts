import ApiService from "../services/ApiService";
import Alert from "../models/project/Alert";
import Check from "../models/project/Check";
import Panel from "../models/project/Panel";
import Project from "../models/project/Project";

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

    public getProject(project: string): Promise<Project> {
        return new Promise<Project>((resolve, reject) => {
            const url = `projects/${project}`;

            this.apiService.get(url)
                .then(response => {
                    const checks: Check[] = [];

                    response.checks.forEach((check: any) => {
                        const {id, alerts, metric, panel, widget} = check;
                        const alertsObj: Alert[] = [];

                        if (alerts) {
                            alerts.forEach((alert: any) => {
                                const {filter, max, min, period} = alert;

                                alertsObj.push(new Alert(filter, max, min, period));
                            });
                        }

                        const panelObj = new Panel(
                            panel.className,
                            panel.order,
                            panel.row,
                            panel.title,
                            panel.zone
                        );

                        checks.push(new Check(id, alertsObj, metric, panelObj, widget));
                    });

                    const result: Project = new Project(response.instance, response.url, checks);

                    resolve(result);
                })
                .catch(error => {
                    reject(error);
                });
        });
    }
}

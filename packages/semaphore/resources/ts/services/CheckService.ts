import {CheckType} from "../types/project/CheckType";
import ProjectRepository from "../repositories/ProjectRepository";

export default class CheckService {
    private static instance: CheckService | null = null;
    private projectRepository: ProjectRepository = ProjectRepository.getInstance();

    private constructor() {
    }

    public static getInstance(): CheckService {
        if (this.instance === null) {
            this.instance = new CheckService();
        }

        return this.instance;
    }

    public getCheckByProjectAndName(projectName: string, checkName: string): Promise<CheckType | undefined> {
        return new Promise<CheckType | undefined>((resolve, reject) => {
            this.projectRepository.getProject(projectName)
                .then(project => {
                    resolve(project.checks.find((check) => check.metric === checkName));
                })
                .catch(error => reject(error));
        });
    }
}

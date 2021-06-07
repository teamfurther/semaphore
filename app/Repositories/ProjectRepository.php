<?php

namespace App\Repositories;

use App\Project;
use App\Ssh;
use Exception;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ProjectRepository
{
    public function all(): array
    {
        $configNames = $this->getAllFileNames(false);

        return array_map(function (string $configName) {
            return $this->getProjectByConfigName($configName);
        }, $configNames);
    }

    private function getAllFileNames(bool $withExtension = true): array
    {
        $escapedFiles = ['.', '..'];
        $fileNames = array_diff(scandir(config_path('projects')), $escapedFiles);

        if ($withExtension) {
            return $fileNames;
        }

        return array_map(function (string $fileName) {
            return preg_replace('/\.[^.]+$/', '', $fileName);
        }, $fileNames);
    }

    public function getByName(string $name): Project
    {
        $project = $this->getProjectByConfigName($name);

        if (is_null($project)) {
            throw new NotFoundHttpException($name . ' not found!');
        }

        return $project;
    }

    private function getProjectByConfigName(string $name): ?Project
    {
        $projectArray = config('projects.' . $name);

        if (is_null($projectArray)) {
            return null;
        }

        if (!$this->validateProjectFile($name)) {
            throw new Exception($name . ' invalid config structure!');
        }

        $ssh = new Ssh(
            $projectArray['ssh']['host'],
            $projectArray['ssh']['key'],
            $projectArray['ssh']['port'],
            $projectArray['ssh']['user']
        );

        return new Project(
            $projectArray['frequency'],
            $projectArray['name'],
            $ssh,
            $projectArray['url']
        );
    }

    private function validateProjectFile(string $name): bool
    {
        $projectKeys = [
            'name', 'url', 'ssh', 'frequency'
        ];
        $sshKeys = [
            'host', 'key', 'port', 'user'
        ];
        $projectArray = config('projects.' . $name);

        if (count(array_diff($projectKeys, array_keys($projectArray))) > 0) {
            return false;
        }

        if (count(array_diff($sshKeys, array_keys($projectArray['ssh']))) > 0) {
            return false;
        }

        return true;
    }
}

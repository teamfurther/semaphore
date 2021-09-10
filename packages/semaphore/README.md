# Semaphore

Semaphore is an extensible dashboard for viewing Prometheus time series, built with Laravel, Tailwind and VueJS.

Out-of-the-box it can monitor global uptime, performance (CPU, memory usage, disk I/O), disk space, SSL certificates and software versions.

Semaphore also allows you to configure notifications, which can be set when certain values pass a preset threshold.

## Installation

1. First, install the package via composer:

```composer require semaphore/semaphore```

2. Publish assets:

```php artisan vendor:publish --tags=semaphore-public```

3. If you wish to override Semaphore default, publish the configuration file: 

```php artisan vendor:publish --tags=semaphore-config```

4. Make sure ```APP_URL``` in ```.env``` is correctly set.

### Setting up Prometheus and Pushgateway

## Project configuration

### Checks

```
"checks" => [
        ...
        [
            "id" => "cpu_usage",
            "alerts" => [
                [
                    "filter" => "process=\"total\"",
                    "max" => .9,
                    "period" => 3 * 60, // 3 minutes
                    "type" => "threshold",
                ],
            ],
            "metric" => "semaphore_cpu_usage",
            "panel" => [
                "className" => "col-span-3",
                "order" => 2,
                "row" => 0,
                "title" => "CPU Usage",
                "zone" => "main",
            ],
            "widget" => "trend",
        ],
        ...
],
```

```panel.className``` - Accepts the following TailwindCSS class groups: ```col-span-*```, ```mb-*``` 

### Main dashboard

### Project dashboards

### Alerts

## Credits

- [Szabolcs BENEDEK](https://github.com/benedek1239)
- [István FARKAS](https://github.com/istvanfarkas96)
- [Peter ILLÉS](https://github.com/ilpet)
- [Csongor UR](https://github.com/csongorur)
- [Norbert ZSOMBORI](https://github.com/zsnorbi)

## License

The MIT License (MIT). Please see [License File](https://github.com/teamfurther/semaphore/blob/master/LICENSE.md) for more information.
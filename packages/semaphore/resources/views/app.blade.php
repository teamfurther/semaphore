<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Semaphore</title>

    <link rel="stylesheet" href="{{ asset('vendor/semaphore/css/app.css') }}" />
</head>
<body class="bg-gray-50">
    <div id="app" data-app-url="{{ config('app.url') . '/' . config('semaphore.routes.prefix') }}"></div>

    <script src="{{ asset('vendor/semaphore/js/app.js') }}?v2"></script>
</body>
</html>
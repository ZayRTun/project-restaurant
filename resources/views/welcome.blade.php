<!DOCTYPE html>

<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Restaurant Mockup</title>

    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @livewireStyles
</head>

<body class="h-full antialiased text-gray-700">
    <livewire:restaurant />

    @livewireScripts
</body>

</html>

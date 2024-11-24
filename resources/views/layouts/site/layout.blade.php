<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full @if($valentine) bg-pink-200 @else bg-gray-100 @endif">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="font-sans antialiased h-full">
<!--
This example requires updating your template:

```
```
-->
<div class="min-h-full">

    <x-site-layout-menu />

    <header class="bg-white shadow">
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{$title ?? 'unknown' }}</h1>
        </div>
    </header>

    <main>
        <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
            <!-- Your content -->
            {{ $slot }}
        </div>
    </main>

    <x-site-layout-footer />
</div>



</body>
</>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-100 dark:bg-gray-900">
        @auth
            @include('layouts.navigation')
        @endauth

        @guest
            @if (Route::has('login'))
            <nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('home') }}">
                                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                                </a>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                                    {{ __('Login') }}
                                </x-nav-link>
                            </div>
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                                    {{ __('Register') }}
                                </x-nav-link>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            @endif
        @endguest 

        <div class="w-full sm:w-[100%] md:w-[80%] lg:w-[70%] xl:w-[70%] m-auto">
            {{$slot}}
        </div>
    </body>
</html>

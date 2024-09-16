<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Price Monitoring System') }}</title> --}}
        <title>Price Monitoring System</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
        @livewireChartsScripts
        
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Livewire.on('errorLabel', event => {
                    showRedToaster(event.message);
                });

                Livewire.on('successLabel', event => {
                    showGreenToaster(event.message);
                });
                
            });

            function showRedToaster(message) {
                const toaster = document.createElement('div');
                toaster.classList.add('redToaster');
                toaster.textContent = message;
                document.body.appendChild(toaster);

                setTimeout(() => {
                    toaster.remove();
                }, 2000);
            }

            function showGreenToaster(message) {
                const toaster = document.createElement('div');
                toaster.classList.add('greenToaster');
                toaster.textContent = message;
                document.body.appendChild(toaster);

                setTimeout(() => {
                    toaster.remove();
                }, 2000);
            }
        </script>
        <style>
            .redToaster {
                position: fixed;
                z-index: 9999999999;
                bottom: 20px;
                right: 20px;
                background-color: #de2f2f;
                color: #fff;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                opacity: 0.9;
            }

            .greenToaster {
                position: fixed;
                z-index: 9999999999;
                bottom: 20px;
                right: 20px;
                background-color: #15b13f;
                color: #fff;
                padding: 10px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                opacity: 0.9;
            }
        </style>

    </body>
</html>

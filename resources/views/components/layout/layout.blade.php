@props ([
    'title' => 'FIT - SIS',
])


<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
       
        <!-- Fonts -->
        
        <!-- Styles / Scripts -->
        {{-- <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" /> --}}
     
        
    </head>

    <body class="text-black bg-primary">
        <x-layout.navbar />
        
        <main class="main-content text-center">
            {{ $slot }}
        </main>    
        <footer class="footer flex items-end justify-end p-4 bg-secondary">
            <a class="link w-auto h-20 place-items-center" href="/about">About Us</a>
            <img class="w-auto h-20" src="{{ asset('build/assets/img/logo.png') }}" alt="logo">
        </footer>
    </body>
</html>
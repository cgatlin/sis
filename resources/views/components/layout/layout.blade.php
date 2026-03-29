@props ([
    'title' => 'FIT - SIS',
])


<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>
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
        <footer class="footer place-items-end p-4 bg-secondary text-neutral-content">
            <a href="/about">About Us</a>
        </footer>
    </body>
</html>
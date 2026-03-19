@props ([
    'title' => 'FIT - SIS',
])


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        
        <!-- Styles / Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />
     
        
    </head>

    <body class="text-black">
        <x-layout.navbar />
        
        <main class="main-content text-center">
            {{ $slot }}
        </main>    
        <footer class="footer place-items-end p-4 bg-secondary text-neutral-content">
            <a href="/about">About Us</a>
        </footer>
    </body>
</html>
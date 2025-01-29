<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Project 2 - {{ $title }}</title>
    <meta name="description" content="Web Technologies Project 2">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Add Bootstrap via CDN -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
        crossorigin="anonymous"
    >
</head>
<body>
    <nav class="navbar bg-primary mb-3" data-bs-theme="dark">
        <header class="container">
            <a class="navbar-brand" href="#">Project 2 - {{ $title }}</a>
        </header>
    </nav>

    <main class="container">
        <div class="row">
            <div class="col">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="text-bg-dark mt-3">
        <div class="container">
            <div class="row py-5">
                <div class="col">
                    K. Grīnvalds, 2025
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS for interactive components -->
    <script 
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-w76A4PnxFnz3gK16gOxSnu1SdPp3+AXYu1M8mBESz1F8vcBuOhc+g+Yw4uANNC7x" 
        crossorigin="anonymous">
    </script>
</body>
</html>

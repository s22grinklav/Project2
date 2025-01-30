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

    <!-- Navigation block -->
    <nav class="navbar navbar-expand-md bg-primary mb-3" data-bs-theme="dark">
        <div class="container">
            <span class="navbar-brand mb-0 h1">Project 2</span> <!-- Project name -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/gpu-generations">GPU Generations</a> <!-- Link to GPU generations section -->
                    </li>
                    <!-- Modify this link to point to GPU Models -->
                    <li class="nav-item">
                        <a class="nav-link" href="/gpu-models">GPU Models</a> <!-- Link to GPU models section -->
                    </li>

                    <!-- Check if user is authenticated -->
                    @if(Auth::check())
                        <!-- Show these links for authenticated users -->
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Log out</a>
                        </li>
                    @else
                        <!-- Show this link for unauthenticated users -->
                        <li class="nav-item">
                            <a class="nav-link" href="/login">Authenticate</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content section -->
    <main class="container">
        <div class="row">
            <div class="col">
                @yield('content') <!-- This is where content from views will be injected -->
            </div>
        </div>
    </main>

    <!-- Footer -->
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

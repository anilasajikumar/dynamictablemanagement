<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frontend</title>
    <!-- Add any required CSS files here -->
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
</head>
<body>
    <header>
        <h1>Dynamic Tables</h1>
        <nav>
            <ul>
                <li><a href="{{ route('frontend.tables.index') }}">Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content') <!-- Section for page-specific content -->
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Dynamic Tables</p>
    </footer>
    <!-- Add any required JS files here -->
    <script src="{{ asset('js/frontend.js') }}"></script>
</body>
</html>

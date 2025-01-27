<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Default Title' }}</title>

    <!-- Dynamic Theme CSS -->
    <x-style/>
</head>
<body>
    <header>
        <x-layout::navigation />
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <x-layout::footer />
    </footer>

    <!-- Dynamic Theme JS -->
    <script src="{{ theme()->getJsPath() }}"></script>
</body>
</html>

<!-- filepath: c:\laragon\www\notion_clone\resources\views\layouts\auth.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Notion Clone</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-white text-black">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md p-8">
            <div class="text-5xl font-bold text-center mb-10">N</div>
            @yield('content')
        </div>
    </div>
</body>
</html>
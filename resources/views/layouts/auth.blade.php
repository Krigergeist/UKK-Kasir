<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | MyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100">

    <div class="flex w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Left side (Image / Branding) -->
        <div class="hidden md:flex md:w-1/2 bg-blue-600 text-white items-center justify-center p-10">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">MyApp</h1>
                <p class="text-lg">Solusi manajemen pengguna yang cepat, aman, dan mudah digunakan.</p>
            </div>
        </div>

        <!-- Right side (Content) -->
        <div class="w-full md:w-1/2 p-8">
            @yield('content')
        </div>
    </div>

</body>

</html>
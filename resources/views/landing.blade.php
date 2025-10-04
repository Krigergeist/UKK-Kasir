<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <a href="#" class="text-2xl font-bold text-blue-600">MyApp</a>
            <div>
                <a href="{{ route('login') }}" class="text-gray-700 px-4 hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="text-gray-700 px-4 hover:text-blue-600">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto text-center py-20 px-6">
        <h1 class="text-5xl font-bold text-gray-800 mb-6">Selamat Datang di Kasir</h1>
        <p class="text-gray-600 mb-8 text-lg">Solusi manajemen pengguna dan sistem login sederhana untuk aplikasi Anda.</p>
        <div>
            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition">Daftar Sekarang</a>
            <a href="{{ route('login') }}" class="ml-4 bg-gray-200 text-gray-800 px-6 py-3 rounded-md hover:bg-gray-300 transition">Masuk</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto grid md:grid-cols-3 gap-8 text-center">
            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-2">Keamanan</h2>
                <p class="text-gray-600">Sistem login yang aman dengan password terenkripsi dan remember me.</p>
            </div>
            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-2">Mudah Digunakan</h2>
                <p class="text-gray-600">Antarmuka sederhana dan cepat digunakan untuk semua pengguna.</p>
            </div>
            <div class="p-6 border rounded-lg shadow hover:shadow-lg transition">
                <h2 class="text-xl font-bold mb-2">Responsive</h2>
                <p class="text-gray-600">Dapat diakses dari desktop, tablet, dan smartphone dengan tampilan optimal.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-100 py-6 mt-12">
        <div class="container mx-auto text-center text-gray-600">
            &copy; {{ date('Y') }} MyApp. All rights reserved.
        </div>
    </footer>

</body>
</html>

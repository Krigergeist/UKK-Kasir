@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Buat Akun Baru</h2>

@if ($errors->any())
<div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('register') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-gray-600">Nama Lengkap</label>
        <input type="text" name="usr_name" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">Nama Toko</label>
        <input type="text" name="usr_shp_name" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">Email</label>
        <input type="email" name="usr_email" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">No. Telepon</label>
        <input type="text" name="usr_phone" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">Password</label>
        <input type="password" name="usr_password" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">Konfirmasi Password</label>
        <input type="password" name="usr_password_confirmation" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
        Register
    </button>
</form>

<p class="text-center text-gray-600 mt-6">
    Sudah punya akun?
    <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
</p>
@endsection
@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Login ke Akun Anda</h2>

@if ($errors->any())
<div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
    {{ $errors->first() }}
</div>
@endif

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf
    <div>
        <label class="block text-gray-600">Email</label>
        <input type="email" name="usr_email" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="block text-gray-600">Password</label>
        <input type="password" name="usr_password" required class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200">
    </div>

    <div class="flex items-center justify-between">
        <label class="flex items-center">
            <input type="checkbox" name="remember" class="mr-2"> Remember me
        </label>
        <a href="#" class="text-sm text-blue-600 hover:underline">Lupa Password?</a>
    </div>

    <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
        Login
    </button>
</form>

<p class="text-center text-gray-600 mt-6">
    Belum punya akun?
    <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a>
</p>
@endsection
@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('login') }}">
    @csrf
    <input type="email" name="usr_email" placeholder="Email" required>
    <input type="password" name="usr_password" placeholder="Password" required>
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label>
    <button type="submit">Login</button>
</form>

@endsection
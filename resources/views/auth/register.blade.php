@extends('layouts.app')
@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf
    <input type="text" name="usr_name" placeholder="Name">
    <input type="text" name="usr_shp_name" placeholder="Shop Name">
    <input type="email" name="usr_email" placeholder="Email">
    <input type="text" name="usr_phone" placeholder="Phone">
    <input type="password" name="usr_password" placeholder="Password">
    <input type="password" name="usr_password_confirmation" placeholder="Confirm Password">
    <button type="submit">Register</button>
</form>
@endsection
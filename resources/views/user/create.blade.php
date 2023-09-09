@extends('master')

@section('content')
    <user-create></user-create>
@endsection


{{-- @extends('layouts.app')
@section('title', 'Página de criação dos usuários')
@section('content')
<h1>tela de criação dos usuários</h1>
<form method="POST" action="{{ route('user.store') }}">
    @csrf

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="phone">Phone:</label>
    <input type="number" name="phone" id="phone" required>

    <label for="document">Document:</label>
    <input type="text" name="document" id="document" required>

    <button type="submit">Create User</button>
</form>
@endsection --}}
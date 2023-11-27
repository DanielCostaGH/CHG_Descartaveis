@extends('master')

@section('content')
    <admin-create></admin-create>
@endsection




{{-- @extends('layouts.app')
@section('title', 'Página de criação dos administradores')
@section('content')
<h1>tela de criação dos administradores</h1>
<form method="POST" action="{{ route('admin.store') }}">
    @csrf

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>

    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>

    <button type="submit">Create Admin</button>
</form>
@endsection --}}
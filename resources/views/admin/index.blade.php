@extends('layouts.app')
@section('title', 'Página de index dos administradores')
@section('content')
<h1><strong>PÁGINA INDEX DOS ADMINISTRADORES</strong></h1>
    <div class="container">
        <h1>Lista de Administradores</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

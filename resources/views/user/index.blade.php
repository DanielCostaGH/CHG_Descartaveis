@extends('layouts.app')
@section('title', 'Página de index dos usuários')
@section('content')
<h1><strong>PÁGINA INDEX DOS USUÁRIOS</strong></h1>
    <div class="container">
        <h1>Lista de Usuários</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Data de Registro</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>{{ $user->document }}</td>
                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

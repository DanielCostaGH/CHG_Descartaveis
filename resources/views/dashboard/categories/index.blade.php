@extends('master')

@section('content')
    <categories-index :categories="{{ $categories }}"/>
@endsection

@extends('master')

@section('content')
    <category-edit :category='@json($category)' />
@endsection
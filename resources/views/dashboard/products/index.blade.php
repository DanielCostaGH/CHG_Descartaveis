@extends('master')

@section('content')
    <products-edit-list :products='@json($products)'/>
@endsection
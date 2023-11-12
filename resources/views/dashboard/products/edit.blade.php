@extends('master')

@section('content')
    <product-edit :product='@json($product)' />
@endsection
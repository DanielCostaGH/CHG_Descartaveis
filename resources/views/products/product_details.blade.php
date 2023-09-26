@extends('master')

@section('content')
<product_details :product="{{ json_encode($product) }}"/>
@endsection



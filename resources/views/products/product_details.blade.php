@extends('master')

@section('content')
<product_details :product="{{ json_encode($product) }}"/>
@endsection




{{-- @extends('master')

@section('content')
    <div>
        Conteúdo da página de detalhes do produto.
        @if(isset($product))
            <pre>{{ json_encode($product, JSON_PRETTY_PRINT) }}</pre>
        @else
            Produto não encontrado.
        @endif
    </div>
@endsection --}}

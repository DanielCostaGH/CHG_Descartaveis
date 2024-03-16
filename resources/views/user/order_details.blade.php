@extends('master')

@section('content')
    <order-details 
        :initial-data="{{ json_encode([
            'order' => $order,
            'transaction' => $transaction,
            'user' => $user,
            'userAddress' => $userAddress,
            'products'    => $products,
        ]) }}"
    ></order-details>
@endsection

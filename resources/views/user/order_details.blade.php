@extends('master')

@section('content')
    <order-details :order="{{ json_encode($order) }}" 
                   :transaction="{{ json_encode($transaction) }}" 
                   :user="{{ json_encode($user) }}" 
                   :userAddress="{{ json_encode($userAddress) }}">
    </order-details>
@endsection

@extends('master')

@section('content')
    <user-index 
        :user-data="{{ json_encode([
            'id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'document' => $userData->document,
            'phonenumber' => $userData->phone,
        ]) }}"
        :user-addresses="{{ $userAddresses }}"
    ></user-index>
@endsection
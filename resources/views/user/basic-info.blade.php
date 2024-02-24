@extends('master')

@section('content')
    <user-info 
        :user-data="{{ json_encode([
            'id' => $userData->id,
            'name' => $userData->name,
            'email' => $userData->email,
            'document' => $userData->document,
            'phonenumber' => $userData->phone,
        ]) }}"
    ></user-info>
@endsection
@extends('layout')

@section('content')
    <user editable="{{ $editable }}" user_json="{{ $user }}" admin="{{ $admin }}" genders_json="{{ $genders }}"></user>
@stop

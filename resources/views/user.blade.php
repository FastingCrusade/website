@extends('layout')

@section('content')
    <user editable="{{ $editable }}" user_json="{{ $user }}" admin="{{ $current_user->is_admin }}" genders_json="{{ $genders }}"></user>
@stop

@extends('layout')

@section('content')
    <home v-if="{{ $logged_in }} === true" cards_json="{{ $cards }}"><i class="loading circle notched icon"></i></home>
    <welcome v-else></welcome>
@stop

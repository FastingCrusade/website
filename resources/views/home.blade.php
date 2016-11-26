@extends('layout')

@section('content')
    <welcome><i class="loading circle notched icon"></i></welcome>
    <div class="ui dropdown">
        <div class="text">
            Test Text
        </div>
        <i class="user icon"></i>
        <div class="menu">
            <div class="item">Account Management</div>
            <div class="item">Log Out<span class="description"><i class="sign out icon"></i></span></div>
        </div>
    </div>
@stop

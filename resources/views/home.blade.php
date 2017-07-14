@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 float auto">
            <div id="content">
                <div class="panel transparent no-border no-box-shadow panel-default" id="app">
                    <router-view></router-view>
                </div>
            </div>
        </div>
    </div>
    @endsection

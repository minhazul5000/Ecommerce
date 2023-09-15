@extends('layouts.MasterFrontend')

@section('title')
    User || Dashboard
@endsection

@section('content')
    <div class="container" style="margin:90px auto">
        <h1>User Dashboard</h1>
        @if(Auth()->check())
            {{Auth()->user()->name}}
        @endif
    </div>
@endsection

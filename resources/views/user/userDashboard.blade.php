@extends('layouts.MasterUser')

@section('title')
    User || Dashboard
@endsection

@section('content')
    <div class="container">
        <h1>User Dashboard</h1>
        @if(Auth()->check())
            {{Auth()->user()->name}}
        @endif
    </div>
@endsection

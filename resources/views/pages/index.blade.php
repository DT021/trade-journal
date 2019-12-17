@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center">
        <h1>{{config('app.name')}}</h1>
        <p>Import and analyze your trades to identify where you are most profitable.</p>
        <p><a class="btn btn-primary btn-lg" href="/login">Login</a> <a class="btn btn-success btn-lg" href="/register">Register</a></p>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<h1>Import Trades</h1>

{!! Form::open(['action' => 'TradesController@store',  'files' => true]) !!}
    <div class="form-group">
      {{Form::file('csv')}}
    </div>
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection
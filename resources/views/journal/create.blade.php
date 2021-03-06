@extends('layouts.app')

@section('content')
<h1>Create New Journal Entry</h1>
{!! Form::open(['action' => 'JournalEntriesController@store', 'class' => 'mb-5']) !!}
<div class="form-group">
    {{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'ckeditor'])}}
</div>
{{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
{!! Form::close() !!}

@endsection
@extends('layouts.app')

@section('content')
    <h1>Create New Journal Entry</h1>
    {!! Form::open(['action' => 'JournalEntriesController@store', 'class' => 'mb-5']) !!}
        <div class="form-group">
            {{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'summary-ckeditor'])}}
        </div>
        {{Form::submit('Create New Entry', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 
@endsection
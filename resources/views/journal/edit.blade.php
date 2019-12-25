@extends('layouts.app')

@section('content')
    <h1>Edit Journal Entry</h1>
    {!! Form::open(['action' => ['JournalEntriesController@update', $journal_entry->id], 'class' => 'mb-5']) !!}
        
        {{-- Need to spoof form method since HTML forms don't allow for PUT--}}
        @method('PUT')  
        
        <div class="form-group">
            {{Form::textarea('body', $journal_entry->body, ['class' => 'form-control', 'id' => 'ckeditor'])}}
        </div>
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!} 
@endsection
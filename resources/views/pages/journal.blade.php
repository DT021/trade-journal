@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Journal</h1>
        {!! Form::open(['action' => 'JournalEntriesController@store', 'class' => 'mb-5']) !!}
            <div class="form-group">
                {{Form::textarea('body', '', ['class' => 'form-control', 'id' => 'summary-ckeditor'])}}
                {{-- <journal-entry-form></journal-entry-form> --}}
            </div>
            {{Form::submit('Create New Entry', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
        <h2>Past Entries</h2>
        @if(count($journal_entries) > 0)
            @foreach($journal_entries as $entry)
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="card-text">{!!$entry->body!!}</p>
                        <small>Written on {{$entry->created_at}}</small>
                    </div>
                </div>
            @endforeach
            {{$journal_entries->links()}}
        @else
            <p>No posts found.</p>
        @endif
    </div>  
@endsection
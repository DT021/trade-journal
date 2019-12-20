@extends('layouts.app')

@section('content')
    <h1>Journal</h1>
    <a href="/journal/create" class="btn btn-primary mb-5">Create New Entry</a>
    @if(count($journal_entries) > 0)
        @foreach($journal_entries as $entry)
            {{-- <div class="card mb-5">
                <div class="card-body">
                    <a href="" class="close"><span aria-hidden="true">&times;</span></a>
                    <p class="card-text">{!!$entry->body!!}</p>
                <a href="/journal/{{$entry->id}}/edit" class="btn btn-secondary btn-small">Edit</a>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Written on {{$entry->created_at}}</small>
                </div>
            </div> --}}
        <journal-entry id='{{$entry->id}}' body='{{$entry->body}}' created_at='{{$entry->created_at}}'></journal-entry>
        @endforeach
        {{$journal_entries->links()}}
    @else
        <p>No posts found.</p>
    @endif
@endsection
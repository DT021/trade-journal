@extends('layouts.app')

@section('content')
    <h1>Journal</h1>
    <a href="/journal/create" class="btn btn-primary mb-5">Create New Entry</a>
    @if(count($journal_entries) > 0)
        {{-- @foreach($journal_entries as $entry)
            <journal-entry id='{{$entry->id}}' body='{{$entry->body}}' created_at='{{$entry->created_at}}'></journal-entry>
        @endforeach --}}
        <journal-entries :meta='{{json_encode($journal_entries)}}'></journal-entries> 
        {{$journal_entries->links()}}
    @else
        <p>No posts found.</p>
    @endif
@endsection
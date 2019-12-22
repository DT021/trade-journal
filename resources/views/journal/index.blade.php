@extends('layouts.app')

@section('content')
    <h1>Journal</h1>
    <a href="/journal/create" class="btn btn-primary mb-5">Create New Entry</a>
    @if(count($journal_entries) > 0)
        <journal-entries :meta='{{json_encode($journal_entries)}}'></journal-entries> 
        {{$journal_entries->links()}}
    @else
        <p>No posts found.</p>
    @endif
@endsection
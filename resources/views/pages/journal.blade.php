@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Journal</h1>
        @if(count($journal_entries) > 0)
            @foreach($journal_entries as $entry)
                <p>{{$entry->body}}</p>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
    
@endsection
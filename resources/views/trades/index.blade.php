@extends('layouts.app')

@section('content')
    @if(count($trades) > 0)
        @foreach ($trades as $trade)
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Symbol</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
            </table>
        @endforeach
    @else
        <p>No Trades Found</p>
    @endif
@endsection
@extends('layouts.app')

@section('content')
    @if(count($groups) > 0)
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">Entered At</th>
                    <th scope="col">Exited At</th>
                    <th scope="col">Symbol</th>
                    <th scope="col">Avg Entry Price</th>
                    <th scope="col">Avg Exit Price</th>
                    <th scope="col">Volume</th>
                    <th scope="col">P/L</th>
                </tr>
            </thead>
        @foreach ($groups as $group)            
            <tr>
                <td>{{$group[0]->executed_at}}</td>
                <td>{{end($group)->executed_at}}</td>
                <td>{{$group[0]->symbol}}</td>
                <td>{{avgEntryPrice($group)}}</td>
                <td>{{avgExitPrice($group)}}</td>

            </tr>
        @endforeach
        </table>
    @else
        <p>No Trades Found</p>
    @endif
@endsection
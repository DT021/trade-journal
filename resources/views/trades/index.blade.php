@extends('layouts.app')

@section('content')
    @if(count($groups) > 0)
        <table class="table table-striped table-sm datatable">
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
            @php
                //$vals = TradesHelper::getCalculatedVals($group);
            @endphp            
            <tr>
                <td>{{$group[0]->executed_at}}</td>
                <td>{{end($group)->executed_at}}</td>
                <td>{{$group[0]->symbol}}</td>
                <td>{{number_format($vals['avg_entry_price'], 2)}}</td>
                <td>{{number_format($vals['avg_exit_price'], 2)}}</td>
                <td>{{$vals['volume']}}</td>
                <td>{{number_format($vals['profit_loss'], 2)}}</td>
            </tr>
        @endforeach
        </table>
    @else
        <p>No Trades Found</p>
    @endif
@endsection
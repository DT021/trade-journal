@extends('layouts.app')

@section('content')
    @if(count($trades) > 0)
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
        @foreach ($trades as $trade)
            @php
                $vals = TradesHelper::getTradeValues($trade);
            @endphp            
            <tr>
                <td>{{$vals['entered_at']}}</td>
                <td>{{$vals['exited_at']}}</td>
                <td>{{$vals['symbol']}}</td>
                <td>{{'$' . number_format($vals['avg_entry_price'], 2)}}</td>
                <td>{{'$' . number_format($vals['avg_exit_price'], 2)}}</td>
                <td>{{$vals['volume']}}</td>
                <td>{{'$' . number_format($vals['profit_loss'], 2)}}</td>
            </tr>
        @endforeach
        </table>
    @else
        <p>No Trades Found</p>
    @endif
@endsection
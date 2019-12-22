<?php

namespace App\Http\Controllers;

use App\Trade;
use Illuminate\Http\Request;

class TradesController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        //Requires the user to be authenticated and verified to access trades
        $this->middleware('auth');
        $this->middleware('verified'); 
    }

    /**
     * Display all of the user's trades.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all trade executions for the user
        $executions = Trade::where('user_id', auth()->user()->id)->orderBy('executed_at')->get();

        // Group the executions
        $groups = $this->groupTrades($executions);

        return view('trades.index')->with('groups', $groups);
    }

    /**
     * Groups trade executions for displaying to the user.
     * 
     * @param \Illuminate\Support\Collection
     * @return 2-dimensional array that represents trade groupings
     */
    //TODO: Handle open trades
    private function groupTrades($executions)
    {
        $result = array();

        // Loop through all executions while keeping track of quantity per symbol in order to create groupings
        $quantities = array();      // $quantities[symbol] = quantity
        $groups = array();      // $groups[symbol] = [executions]
        foreach($executions as $exec) {
            $symbol = $exec->symbol;
            $quantity = $exec->quantity;

            // If action was a sell, make quantity negative
            if (strpos($exec->action, 'SELL') !== false) {
                $quantity *= -1;
            }


            if (array_key_exists($symbol, $quantities) && array_key_exists($symbol, $groups)) {
                $quantities[$symbol] += $quantity;
                array_push($groups[$symbol], $exec);
                
                // If quantity is 0, then trade is closed. Add to result.
                if ($quantities[$symbol] == 0) {
                    array_push($result,  $groups[$symbol]);
                    // Remove elements
                    unset($quantities[$symbol]);
                    unset($groups[$symbol]);
                }

            } else {
                $quantities[$symbol] = $quantity;
                $groups[$symbol] = array($exec);
            }
        }

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        if ($request->hasFile('file')) {
            // Get path to uploaded CSV file
            $path = $request->file('file')->getRealPath();

            // Create associative array from CSV
            $rows   = array_map('str_getcsv', file($path));
            $header = array_shift($rows);
            $records = array();
            foreach($rows as $row) {
                $records[] = array_combine($header, $row);
            }

            // Counter for success message
            $num_trades = 0;

            // Loop through the file
            foreach($records as $record) {
                $num_trades++;

                // Create new trade
                // TODO: Expand for other brokers besides TastyWorks
                $trade = new Trade;
                $trade->user_id = auth()->user()->id;

                // Format date for MySQL
                $trade->executed_at = join(' ', explode('T', substr($record['Date'], 0, -5)));
                
                $trade->action = $record['Action'];
                $trade->symbol = $record['Underlying Symbol'];
                $trade->instrument_type = $record['Instrument Type'];
                $trade->value = floatval($record['Value']);
                $trade->quantity = intval($record['Quantity']);
                $trade->commissions = floatval($record['Commissions']);
                $trade->fees = floatval($record['Fees']);
                $trade->expiration = $record['Expiration Date'];
                $trade->strike_price = floatval($record['Strike Price']);
                $trade->call_or_put = $record['Call or Put'];
                $trade->save();
            };
            
            return redirect('/trades')->with('success', $num_trades.' Trades Were Imported');
        } else {
            return "No file";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $trade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $trade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $trade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $trade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $trade)
    {
        //
    }

    /**
     * Show the form for importing trades
     * 
     * @return \Illuminate\Http\Response
     */

    public function import()
    {
        return view('trades.import');
    }
}

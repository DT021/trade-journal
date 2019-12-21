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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trades.index');
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

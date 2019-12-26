<?php

namespace App\Http\Controllers;

use App\Trade;
use App\Execution;
use Illuminate\Http\Request;
use App\Helpers\TradesHelper;

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
        $trades = auth()->user()->trades()->get();
        

        // Group the executions
        //$groups = TradesHelper::groupTrades($executions);

        //return view('trades.index')->with('groups', $groups);
        return $trades;
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
    // TODO: Expand for other brokers besides TastyWorks
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required'
        ]);

        // Get path to uploaded CSV file
        $path = $request->file('file')->getRealPath();

        // Create associative array from CSV
        $rows   = array_map('str_getcsv', file($path));
        $header = array_shift($rows);
        $records = array();
        foreach ($rows as $row) {
            $records[] = array_combine($header, $row);
        }

        // Counter for success message
        $num_executions = 0;

        // Array to save all executions being imported in order to group them later.
        $executions = array();

        // Create a new execution for each record.
        foreach ($records as $record) {
            $num_executions++;

            $execution = new Execution;
            $execution->user_id = auth()->user()->id;
            // Format date for MySQL
            $execution->executed_at = join(' ', explode('T', substr($record['Date'], 0, -5)));
            $execution->action = $record['Action'];
            $execution->symbol = $record['Underlying Symbol'];
            $execution->instrument_type = $record['Instrument Type'];
            $execution->value = floatval(str_replace(',', '', $record['Value']));
            $execution->quantity = intval(str_replace(',', '', $record['Quantity']));
            $execution->avg_price = floatval(str_replace(',', '', $record['Average Price']));
            $execution->commissions = floatval(str_replace(',', '', $record['Commissions']));
            $execution->fees = floatval(str_replace(',', '', $record['Fees']));
            $execution->expiration = $record['Expiration Date'];
            $execution->strike_price = floatval(str_replace(',', '', $record['Strike Price']));
            $execution->call_or_put = $record['Call or Put'];
            $execution->save();

            array_push($executions, $execution);
        };

        // Group executions into trades
        $groups = TradesHelper::groupTrades($executions);

        // Create a new trade for each group
        foreach($groups as $group) {
            $trade = new Trade;
            $trade->user()->associate(auth()->user());
            $trade->save();
            foreach($group as $execution) {
                $execution->trade()->associate($trade);
            }
        }

        return redirect('/trades')->with('success', $num_executions . ' Trades Executions Were Imported');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trade  $execution
     * @return \Illuminate\Http\Response
     */
    public function show(Trade $execution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trade  $execution
     * @return \Illuminate\Http\Response
     */
    public function edit(Trade $execution)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trade  $execution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trade $execution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trade  $execution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trade $execution)
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

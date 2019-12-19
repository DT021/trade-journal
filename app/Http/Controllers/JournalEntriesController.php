<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class JournalEntriesController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        //Requires the user to be authenticated and verified to access the journal
        $this->middleware('auth');
        $this->middleware('verified'); 
    }

    /**
     * Display all of the user's journal entries.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $journal_entries = JournalEntry::where('user_id', $user_id)->paginate(5);
        return view('journal.index')->with('journal_entries', $journal_entries);
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
            'body' => 'required'
        ]);

        // Create journal entry
        $journal_entry = new JournalEntry;
        $journal_entry->body = $request->input('body');
        $journal_entry->user_id = auth()->user()->id;
        $journal_entry->save();

        return redirect('/journal');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

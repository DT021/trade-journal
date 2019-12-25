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
        $journal_entries = auth()->user()->journal_entries()->orderBy('created_at', 'desc')->paginate(5);
        return view('journal.index')->with('journal_entries', $journal_entries);
    }

    /**
     * Show the form for creating a new journal entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('journal.create');
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

        return redirect('/journal')->with('success', 'Journal Entry Created');
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
     * Show the form for editing a journal entry.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $journal_entry = JournalEntry::findOrFail($id);
        
        if (auth()->user()->cant('update', $journal_entry)) {
            return redirect('/journal')->with('error', 'Unauthorized Page');
        }

        return view('journal.edit')->with('journal_entry', $journal_entry);
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
        $this->validate($request, [
            'body' => 'required'
        ]);

        // Create journal entry
        $journal_entry = JournalEntry::find($id);
        $journal_entry->body = $request->input('body');
        $journal_entry->save();

        return redirect('/journal')->with('success', 'Journal Entry Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $journal_entry = JournalEntry::findOrFail($id);

        if (auth()->user()->cant('delete', $journal_entry)) {
            return redirect('/journal')->with('error', 'Unauthorized Page');
        }

        $journal_entry->delete();
        return redirect('/journal')->with('success', 'Journal Entry Deleted');
    }
}

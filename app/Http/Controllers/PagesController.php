<?php

namespace App\Http\Controllers;

use App\JournalEntry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]); 
    }

    public function index() 
    {
        // If the user is authenticated, redirect to journal
        if (Auth::check()) {
            return redirect('/journal');
        }
        return view('pages.index');
    }

    /* public function journal() 
    {
        $user_id = Auth::user()->id;
        $journal_entries = JournalEntry::where('user_id', $user_id)->get();
        return view('pages.journal')->with('journal_entries', $journal_entries);
    } */
}

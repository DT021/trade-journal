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
        // Users must be authenticated to access all pages except index
        $this->middleware('auth', ['except' => ['index']]); 
    }

    public function index() 
    {
        // If the user is authenticated, redirect to /journal
        if (auth()->check()) {
            return redirect('/journal');
        }
        return view('pages.index');
    }
}

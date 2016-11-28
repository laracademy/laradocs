<?php

namespace App\Http\Controllers\Administration;

use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdministrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.index', [
            'versions' => Version::orderBy('tag')->get()
        ]);
    }
}

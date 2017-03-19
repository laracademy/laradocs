<?php

namespace App\Http\Controllers\Administration\Dashboard;

use App\Models\Version;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        return view('administration.dashboard.index', [
            'documentCount' => Document::count(),
            'versionCount'  => Version::count(),
        ]);
    }

}
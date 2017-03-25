<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    /**
     * returns the no documentation view
     */
    public function noDocumentation()
    {
        return view('front.errors.no-documentation', [
            'navigation' => [],
        ]);
    }

    /**
     * returns the no landing page view
     */
    public function noLandingPage()
    {
        return view('front.errors.no-landing-page', [
            'navigation' => [],
        ]);
    }
}
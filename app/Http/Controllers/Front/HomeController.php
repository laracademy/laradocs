<?php

namespace App\Http\Controllers\Front;

use App\Models\Version;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * handles where to redirect the user on initial page load
     */
    public function index()
    {
        // check to see if any documentation is installed and active
        $version = $this->getVersion();

        if(! $version) {
            return redirect()->route('front.errors.no-documentation');
        }

        // we have a active and default version, but no landing page
        if(! $version->defaultDocument) {
            return redirect()->route('front.errors.no-landing-page');
        }

        // we have an active, default version with a landing page, so redirect
        return redirect()->route('front.document.view', [$version->slug, $version->defaultDocument->slug]);
    }




    public function getVersion()
    {
        // Grab version from Session
        $version = session()->get('version', Version::getDefaultVersion()->first());

        if(! $version) {
            return null;
        }

        // Check to see if version is still correct
        $version = Version::where('id', $version->id)->first();
        if(! $version) {
            $version = Version::getDefaultVersion()->first();
            $this->setVersion($version->slug);
        }

        return $version;
    }
}
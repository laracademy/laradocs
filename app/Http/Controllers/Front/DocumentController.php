<?php

namespace App\Http\Controllers\Front;

use App\Models\Setting;
use App\Models\Version;
use App\Models\Document;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    // methods needed
    // index
    // view

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
        return redirect()->route('front.view', [$version->slug, $version->defaultDocument->slug]);
    }



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // // share all of the active versions on the front page
        // view()->share('active_versions', Version::getActive()->get());

        // // share the theme across all functions
        // $theme = '';
        // $themeSetting = Setting::getSetting('theme');
        // if($themeSetting) {
        //     $theme = $themeSetting;
        // }

        // view()->share('theme', $theme);

        // // share the site name across all functions
        // view()->share('site_name', Setting::getSetting('site_name'));
    }


    /**
     * the view that shows when no documentation has been found
     * this should be only a one time thing, hopefully
     * @return [type] [description]
     */
    public function noDocumentation()
    {
        return view('front.no-documentation');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index44()
    {
        // first we need to find out if we have any documentation online
        $version = $this->getVersion();

        if(! $version) {
            return redirect()->route('documentation.none');
        }

        // Get current version that has been either assigned
        // or is active and default
        $version = $this->getVersion();

        // this isn't needed
        // Build the navigation for the "current" version
        $navigation = $this->buildNavigation($version);

        // Check to see if the current version has a default starting page
        if($version->defaultDocument) {
            // Redirect to that default starting page
            return redirect()->route('document.view', [$version->slug, $version->defaultDocument->slug]);
        }

        return view('front.start', [
            'navigation' => $navigation
        ]);
    }

    public function view($version_slug, $document_slug)
    {
        $version = Version::where('slug', str_slug($version_slug))->first();
        $document = \App\Models\Document::where('version_id', $version->id)->where('slug', str_slug($document_slug))->first();
        // Build the navigation for the "current" version
        $navigation = $this->buildNavigation($version);

        return view('front.document', compact('version', 'document', 'navigation'));
    }



    /**
     * return selected version, otherwise default version
     * from database
     */
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

    /**
     * sets the version
     */
    public function setVersion($slug)
    {
        $version = Version::getActive()->where('slug', str_slug($slug))->first();

        if($version)
        {
            session()->set('version', $version);
        }
        else
        {
            session()->set('version', Version::getDefaultVersion()->first());
        }

        return redirect()->route('home');
    }

    /**
     * builds navigation for left side
     */
    public function buildNavigation($version)
    {
        return $version->navigation()->where('is_heading', true)->orderBy('sorting')->get()->map(function($item, $index) {
            return [
                'title' => $item->title,
                'is_heading' => $item->is_heading,
                'sub_navigation' => $item->sub_navigation()->orderBy('sorting')->get()->map(function($subItem, $subIndex) {
                    // only one deep
                    return [
                        'title' => $subItem->title ? $subItem->title : $subItem->document->title,
                        'is_heading' => false,
                        'document_id' => $subItem->document_id,
                        'slug' => $subItem->document->slug,
                    ];
                })
            ];
        });
    }
}

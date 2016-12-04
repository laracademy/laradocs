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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // share all of the active versions on the front page
        view()->share('active_versions', Version::getActive()->get());

        // todo; organize below

        // share the navigation between all functions
        //view()->share('navigation', $this->buildNavigation());

        // get the version to display
        view()->share('version', $this->getVersion());

        // share the theme across all functions
        $theme = '';
        $themeSetting = Setting::getSetting('theme');
        if($themeSetting) {
            $theme = $themeSetting;
        }

        view()->share('theme', $theme);

        // share the site name across all functions
        view()->share('site_name', Setting::getSetting('site_name'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get current version that has been either assigned
        // or is active and default
        $currentVersion = $this->getVersion();

        // Build the navigation for the "current" version
        $navigation = $this->buildNavigation($currentVersion);

        // Check to see if the current version has a default starting page
        if($currentVersion) {
            if(Document::where('id', intval($currentVersion->default_document_id))->first()) {

                // Redirect to that default starting page
                return redirect()->route('document.view', [$currentVersion->slug, $currentVersion->defaultDocument->slug]);
            }
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
        return session()->get('version', Version::getDefaultVersion()->first());
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

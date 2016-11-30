<?php

namespace App\Http\Controllers\Front;

use App\Models\Version;
use \App\Models\Setting;
use \App\Models\Navigation;
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
        view()->share('navigation', $this->buildNavigation());

        // get the version to display
        // @TODO this will change
        view()->share('version', \App\Models\Version::getDefaultVersion()->first());

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
        // check to see if the version has an assigned default page
        $currentVersion = view()->shared('version');

        if($currentVersion) {
            if(intval($currentVersion->default_document_id) > 0) {
                return redirect()->route('document.view', [$currentVersion->slug, $currentVersion->defaultDocument->slug]);
            }
        }

        return view('front.start');
    }

    public function view($version_slug, $document_slug)
    {
        $version = \App\Models\Version::where('slug', str_slug($version_slug))->first();
        $document = \App\Models\Document::where('version_id', $version->id)->where('slug', str_slug($document_slug))->first();

        return view('front.document', compact('version', 'document'));
    }

    public function buildNavigation()
    {
        // for now
        $version = \App\Models\Version::getDefaultVersion()->first();

        if(! $version) {
            return null;
        }

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

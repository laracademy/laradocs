<?php

namespace App\Http\Controllers\Front;

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
        // share the navigation between all functions
        view()->share('navigation', $this->buildNavigation());

        // get the version to display
        view()->share('version', \App\Models\Version::where('is_default', 1)->first());

        // share the theme across all functions
        $theme = '';
        $themeSetting = \App\Models\Setting::getSetting('theme');
        if($themeSetting) {
            $theme = $themeSetting;
        }

        view()->share('theme', $theme);

        // share the site name across all functions
        view()->share('site_name', \App\Models\Setting::getSetting('site_name'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $version = \App\Models\Version::where('is_default', 1)->first();

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

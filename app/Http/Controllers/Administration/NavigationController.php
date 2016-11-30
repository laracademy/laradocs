<?php

namespace App\Http\Controllers\Administration;

use App\Models\Version;
use App\Models\Document;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NavigationController extends Controller
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
    public function index(\App\Models\Version $version)
    {
        return view('administration.navigation.index', [
            'version'    => $version,
            'navigation' => Navigation::buildAll($version->id),
        ]);
    }

    /**
     * handles showing the form to create a new section
     */
    public function createSection(\App\Models\Version $version)
    {
        return view('administration.navigation.create.section', [
            'version' => $version
        ]);
    }

    /**
     * handles saving a new section
     */
    public function storeSection(Request $request)
    {
        $navigation             = new Navigation;
        $navigation->is_heading = true;
        $navigation->version_id = intval($request->input('version_id'));
        $navigation->title      = $request->input('title');

        // find new rank
        $navigationItems = Navigation::where('version_id', $navigation->version_id);
        $navigation->sorting = $navigationItems->count() > 0 ? $navigationItems->orderBy('sorting', 'desc')->first()->sorting + 50 : 0;
        $navigation->save();

        return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['Your Section Header was created successfully.']);
    }

    /**
     * handles showing the form to add an existing document
     */
    public function createDocument(\App\Models\Navigation $navigation)
    {
        return view('administration.navigation.create.document', [
            'navigation' => $navigation,
            'documents'  => $navigation->version->documents()->orderBy('title')->get(),
        ]);
    }

    /**
     * handles saving a new section
     */
    public function storeDocument(Request $request)
    {

        // first look up the parent navigation
        $parentNavigation = Navigation::find($request->input('navigation_id'));

        $navigation              = new Navigation;
        $navigation->is_heading  = false;
        $navigation->version_id  = $parentNavigation->version_id;
        $navigation->parent_id   = $parentNavigation->id;
        $navigation->title       = $request->input('title');
        $navigation->document_id = intval($request->input('document_id'));

        // find new rank
        $navigationItems = Navigation::where('version_id', $navigation->version_id)->where('parent_id', $parentNavigation->id)->orderBy('sorting');
        $navigation->sorting = $navigationItems->count() > 0 ? $navigationItems->orderBy('sorting', 'desc')->first()->sorting + 50 : 0;

        $navigation->save();

        if(intval($request->input('add_redirect')) == 1) {
            return redirect()->route('administration.navigation.create.document', $parentNavigation->id)->with('success', ['The document has been added to the navigation successfully.']);
        }

        return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['The document has been added to the navigation successfully.']);
    }

    public function destroy(\App\Models\Navigation $navigation)
    {
        // remove sub navigation
        if(count($navigation->sub_navigation) > 0) {
            foreach($navigation->sub_navigation as $subNavigation) {
                $subNavigation->delete();
            }
        }

        // remove self
        $navigation->delete();

        // redirect back
        return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['Your Navigation item was deleted successfully.']);
    }

    public function rankUp(\App\Models\Navigation $navigation)
    {
        // find navigation above
        $aboveNavigationItem = Navigation::where('sorting', '<', $navigation->sorting)->orderBy('sorting', 'desc')->first();

        if($aboveNavigationItem) {
            // take away one
            $navigation->sorting = ($aboveNavigationItem->sorting - 1);
            $navigation->save();
        }

        // if we are here we cannot move this item up
        // because it is already first
        return back();
    }

}

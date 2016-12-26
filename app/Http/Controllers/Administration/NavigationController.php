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
     * handles editing an existing navigation section
     */
    public function editSection(\App\Models\Navigation $navigation)
    {
        return view('administration.navigation.edit.section', [
            'navigation' => $navigation,
        ]);
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
        $navigationItems = Navigation::where('version_id', $navigation->version_id)->where('parent_id', $parentNavigation->id);
        $navigation->sorting = $navigationItems->count() > 0 ? $navigationItems->orderBy('sorting', 'desc')->first()->sorting + 50 : 0;

        $navigation->save();

        if(intval($request->input('add_redirect')) == 1) {
            return redirect()->route('administration.navigation.create.document', $parentNavigation->id)->with('success', ['The document has been added to the navigation successfully.']);
        }

        return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['The document has been added to the navigation successfully.']);
    }

    /**
     * handles editing an existing navigation document link
     */
    public function editDocument(\App\Models\Navigation $navigation)
    {
        return view('administration.navigation.edit.document', [
            'navigation' => $navigation,
            'documents'  => $navigation->version->documents()->orderBy('title')->get(),
        ]);
    }

    /**
     * handles updating the navigation item
     */
    public function updateNavigation(Request $request)
    {
        $navigation = Navigation::find($request->input('id'));

        $navigation->document_id = $request->input('document_id');
        if($request->has('title')) {
            $navigation->title = $request->input('title');
        }
        $navigation->save();

        return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['The navigation item has been updated successfully.']);
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

    public function rankDown(\App\Models\Navigation $navigation)
    {

        $subNavigation = Navigation::where('parent_id', $navigation->parent_id)->select('id', 'sorting')->orderBy('sorting')->get()->toArray();
        $indexToMove = collect($subNavigation)->where('id', $navigation->id)->keys()->pop();

        $item = $subNavigation[ $indexToMove ];
        $subNavigation[ $indexToMove ] = $subNavigation[ $indexToMove + 1 ];
        $subNavigation[ $indexToMove + 1 ] = $item;

        collect($subNavigation)->each(function($item, $key) {
            $navigation = Navigation::where('id', $item['id'])->first();
            $navigation->sorting = $key * 10;
            $navigation->save();
        });

        return redirect()->route('administration.navigation', $navigation->version_id);
    }

    public function rankUp(\App\Models\Navigation $navigation)
    {

        $subNavigation = Navigation::where('parent_id', $navigation->parent_id)->select('id', 'sorting')->orderBy('sorting')->get()->toArray();
        $indexToMove = collect($subNavigation)->where('id', $navigation->id)->keys()->pop();

        $item = $subNavigation[ $indexToMove ];
        $subNavigation[ $indexToMove ] = $subNavigation[ $indexToMove - 1 ];
        $subNavigation[ $indexToMove - 1 ] = $item;

        collect($subNavigation)->each(function($item, $key) {
            $navigation = Navigation::where('id', $item['id'])->first();
            $navigation->sorting = $key * 10;
            $navigation->save();
        });

        return redirect()->route('administration.navigation', $navigation->version_id);
    }

}
<?php

namespace App\Http\Controllers\Administration;

use Parsedown;
use App\Models\Version;
use App\Models\Document;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
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
     * will load up a specified version's documents
     */
    public function index(\App\Models\Version $version)
    {
        // load documents accordingly
        return view('administration.documentation.index', [
            'version'   => $version,
            'documents' => $version->documents()->orderBy('title')->get()
        ]);
    }

    /**
     * handles the create form
     */
    public function create(\App\Models\Version $version, $navigation = null)
    {
        return view('administration.documentation.create', [
            'version'       => $version,
            'document'      => new Document(),
            'navigation_id' => $navigation ? $navigation : null,
        ]);
    }

    /**
     * handles the insert of the document
     */
    public function store(Request $request)
    {
        $Parsedown            = new Parsedown;
        $document             = new Document;
        $document->version_id = $request->input('version_id');
        $document->title      = $request->input('title');
        $document->slug       = str_slug($document->title);
        $document->markdown   = $request->input('markdown');
        $document->html       = $Parsedown->text($document->markdown);
        $document->save();

        if($request->has('navigation_id')) {
            $navigation              = new Navigation;
            $navigation->is_heading  = false;
            $navigation->version_id  = $document->version_id;
            $navigation->parent_id   = $request->input('navigation_id');
            $navigation->title       = '';
            $navigation->document_id = $document->id;

            // find new rank
            $navigationItems = Navigation::where('version_id', $navigation->version_id)->where('parent_id', $navigation->parent_id)->orderBy('sorting');
            $navigation->sorting = $navigationItems->count() > 0 ? $navigationItems->first()->sorting + 50 : 0;

            $navigation->save();

            return redirect()->route('administration.navigation', $navigation->version_id)->with('success', ['The document has been created and added to the navigation successfully.']);
        }

        return redirect()->route('administration.version.view', $document->version)->with('success', ['The Documentation titled: "'. $document->title .'" for version: "'. $document->version->tag .'" was created succesfully.']);
    }

    /**
     * handles the edit document form
     */
    public function edit(\App\Models\Document $document)
    {
        return view('administration.documentation.edit', [
            'document' => $document,
        ]);
    }

    /**
     * handles updating the document
     */
    public function update(Request $request, \App\Models\Document $document)
    {
        $Parsedown          = new Parsedown;
        $document->title    = $request->input('title');
        $document->slug     = str_slug($document->title);
        $document->markdown = $request->input('markdown');
        $document->html     = $Parsedown->text($document->markdown);
        $document->save();

        return redirect()->route('administration.documentation', $document->version)->with('success', ['The Documentation titled: "'. $document->title .'" for version: "'. $document->version->tag .'" was updated succesfully.']);
    }

    public function destroy(\App\Models\Document $document)
    {
        // remove any navigation
        Navigation::where('document_id', $document->id)->delete();

        // remove self
        $document->delete();

        return back()->with('success', ['The document was removed and any navigation was also removed.']);
    }

}

<?php

namespace App\Http\Controllers\Administration;

use App\Models\Version;
use App\Models\Document;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VersionController extends Controller
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

    public function index()
    {
        return view('administration.version.index', [
            'versions' => Version::all(),
        ]);
    }

    /**
     * handles create form
     */
    public function create()
    {
        return view('administration.version.create', [
            'version' => new Version,
        ]);
    }

    /**
     * handles storing the version
     */
    public function store(Request $request)
    {
        $version = Version::create([
            'name'   => $request->input('name'),
            'slug'   => str_slug($request->input('name')),
            'active' => $request->input('active'),
        ]);

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration.version')->with('success', 'The Version was created succesfully.');
    }

    /**
     * handles the editing form
     */
    public function edit(Version $version)
    {
        // default document to choose from
        $documents = $version->documents->sortBy('title')->pluck('title', 'id');

        return view('administration.version.edit', [
            'version'    => $version,
            'documents'  => $documents,
        ]);
    }

    /**
     * handles the update of the version
     */
    public function update(Request $request, \App\Models\Version $version)
    {
        $version->document_id         = intval($request->input('document_id')) != 0 ? intval($request->input('document_id')) : null;
        $version->name                = $request->input('name');
        $version->slug                = str_slug($version->name);
        $version->active              = $request->input('active');
        $version->save();

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration.version')->with('success', 'The Version was updated succesfully.');
    }

    /**
     * handles removing the version and all associated items
     */
    public function destroy(Version $version)
    {
        // remove version's navigation
        Navigation::where('version_id', $version->id)->delete();

        // remove version's documents
        Document::where('version_id', $version->id)->delete();

        // remove version
        $version->delete();

        return redirect()->route('administration.version')->with('success', 'The Version was removed succesfully.');
    }

    public function manage(Version $version)
    {
        return view('administration.version.manage', [
            'version' => $version,
        ]);
    }
}

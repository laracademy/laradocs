<?php

namespace App\Http\Controllers\Administration\Version;

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

    /**
     * will list all of the versions found on the system
     * @return [type] [description]
     */
    public function index()
    {
        return view('administration.versions.index', [
            'versions' => Version::all(),
        ]);
    }

    /**
     * handles create form
     */
    public function create()
    {
        return view('administration.versions.create', [
            'version' => new Version,
        ]);
    }

    /**
     * handles storing the version
     */
    public function store(Request $request)
    {

        // validate
        $this->validate($request, ['name' => 'required']);

        // create the version
        $version = Version::create([
            'name'   => $request->input('name'),
            'slug'   => str_slug($request->input('name')),
            'active' => $request->input('active'),
        ]);

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration.versions')->with('success', 'The Version was created succesfully.');
    }

    /**
     * handles the editing form
     */
    public function edit(Version $version)
    {
        // default document to choose from
        $documents = $version->documents->sortBy('title')->pluck('title', 'id');

        return view('administration.versions.edit', [
            'version'    => $version,
            'documents'  => $documents,
        ]);
    }

    /**
     * handles the update of the version
     */
    public function update(Request $request, Version $version)
    {
        $version->document_id         = intval($request->input('document_id')) != 0 ? intval($request->input('document_id')) : null;
        $version->name                = $request->input('name');
        $version->slug                = str_slug($version->name);
        $version->active              = $request->input('active');
        $version->save();

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration.versions')->with('success', 'The Version "'. $version->name .'" was updated succesfully.');
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

        return redirect()->route('administration.versions')->with('success', 'The Version was removed succesfully.');
    }

    /**
     * shows the dashboard for the specified version
     * @param  Version $version [description]
     * @return [type]           [description]
     */
    public function dashboard(Version $version)
    {
        return view('administration.versions.dashboard', [
            'version' => $version,
        ]);
    }
}

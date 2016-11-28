<?php

namespace App\Http\Controllers\Administration;

use App\Models\Version;
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
            'tag'    => $request->input('tag'),
            'slug'   => str_slug($request->input('tag')),
            'active' => $request->input('active'),
        ]);

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration')->with('success', ['The Version was created succesfully.']);
    }

    /**
     * handles the editing form
     */
    public function edit(\App\Models\Version $version)
    {
        return view('administration.version.edit', [
            'version' => $version,
        ]);
    }

    /**
     * handles the update of the version
     */
    public function update(Request $request, \App\Models\Version $version)
    {
        $version->tag    = $request->input('tag');
        $version->slug   = str_slug($version->tag);
        $version->active = $request->input('active');
        $version->save();

        $version->setDefault($request->input('is_default'));

        return redirect()->route('administration')->with('success', ['The Version was updated succesfully.']);
    }
}

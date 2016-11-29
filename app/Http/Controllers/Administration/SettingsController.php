<?php

namespace App\Http\Controllers\Administration;

use App\Models\Setting;
use App\Models\Version;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
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
     * lists all the settings
     */
    public function index()
    {
        // grab all settings
        $settings = Setting::all()->pluck('parameter', 'setting');

        // default version
        $version = Version::getDefaultVersion()->first();

        // @TODO: Build into array, and sort entire array with nav->title vs document->title
        // grab navigation from said version above
        $navigation = $version->navigation()->where('is_heading', false)->get();

        $siteSettings = [
            'site_name'       => isset($settings['site_name']) ? $settings['site_name'] : '',
            'theme'           => isset($settings['theme']) ? $settings['theme'] : '',
            'github_username' => isset($settings['github_username']) ? $settings['github_username'] : '',
            'github_token'    => isset($settings['github_token']) ? $settings['github_token'] : '',
            'default_page'    => isset($settings['default_page']) ? $settings['default_page'] : '',
        ];

        return view('administration.settings.index', [
            'settings'   => $siteSettings,
            'navigation' => $navigation,
        ]);
    }

    /**
     * handles saving the settings
     */
    public function update(Request $request)
    {
        // truncate all settings except github
        Setting::where('setting', 'site_name')->delete();
        Setting::where('setting', 'theme')->delete();
        Setting::where('setting', 'github_username')->delete();
        Setting::where('setting', 'default_page')->delete();

        // Save all settings
        Setting::create(['setting' => 'site_name', 'parameter' => $request->input('site_name')]);
        Setting::create(['setting' => 'theme', 'parameter' => $request->input('theme')]);
        Setting::create(['setting' => 'github_username', 'parameter' => $request->input('github_username')]);
        Setting::create(['setting' => 'default_page', 'parameter' => $request->input('default_page')]);

        if(strlen($request->input('github_token')) > 0)
        {
            Setting::where('setting', 'github_token')->delete();
            Setting::create(['setting' => 'github_token', 'parameter' => $request->input('github_token')]);
        }

        return redirect()->route('administration.settings')->with('success', ['Your settings have been updated.']);
    }

    /**
     * removes the access  token
     */
    public function destroyToken()
    {
        Setting::where('setting', 'github_token')->delete();

        return redirect()->route('administration.settings')->with('success', ['The Github Access Token was removed successfully']);
    }

}

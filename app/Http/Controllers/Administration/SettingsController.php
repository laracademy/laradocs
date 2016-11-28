<?php

namespace App\Http\Controllers\Administration;

use App\Models\Setting;
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
        $settings = Setting::all()->pluck('parameter', 'setting');

        $siteSettings = [
            'site_name'       => isset($settings['site_name']) ? $settings['site_name'] : '',
            'theme'           => isset($settings['theme']) ? $settings['theme'] : '',
            'github_username' => isset($settings['github_username']) ? $settings['github_username'] : '',
            'github_token'    => isset($settings['github_token']) ? $settings['github_token'] : '',
        ];

        return view('administration.settings.index', [
            'settings' => $siteSettings,
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

        // Save all settings
        Setting::create(['setting' => 'site_name', 'parameter' => $request->input('site_name')]);
        Setting::create(['setting' => 'theme', 'parameter' => $request->input('theme')]);
        Setting::create(['setting' => 'github_username', 'parameter' => $request->input('github_username')]);
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

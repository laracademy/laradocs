<?php

namespace App\Http\Controllers\Administration\Imports;

use Parsedown;
use GuzzleHttp\Client;
use App\Models\Setting;
use App\Models\Version;
use App\Models\Document;
use App\Models\Navigation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GithubController extends Controller
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
    public function index()
    {
        return view('administration.imports.github.index', [
            'versions' => Version::orderBy('tag')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // rules
        $rules = [
            'version_id'        => 'required',
            'repository_name'   => 'required',
            'repository_owner'  => 'required',
            'repository_branch' => 'required',
        ];

        $this->validate($request, $rules);

        // @TODO: should probably fire a job to handle this in queues

        $github_username = trim(Setting::getSetting('github_username'));
        $github_token    = trim(Setting::getSetting('github_token'));
        $client          = new Client;
        $version         = Version::find($request->input('version_id'));

        // easy variable names
        $owner  = $request->input('repository_owner');
        $name   = $request->input('repository_name');
        $folder = $request->input('repository_folder');
        $branch = $request->input('repository_branch');

        // load all files from Github
        $response = $client->request('GET',
            "https://api.github.com/repos/{$owner}/{$name}/contents/{$folder}?ref={$branch}",
            ['auth' => [$github_username, $github_token]]
        );

        if($response->getStatusCode() != 200) {
            return redirect()->back()->withErrors($response->getReasonPhrase());
        }

        // files
        $files = json_decode($response->getBody()->getContents());

        // loop through files to read them
        foreach($files as $file)
        {
            $fileResponse = $client->request('GET',
                "https://api.github.com/repos/{$owner}/{$name}/contents/{$file->path}?ref={$branch}",
                ['auth' => [$github_username, $github_token]]
            );

            $fileContent = json_decode($fileResponse->getBody()->getContents());
            $fileContent = base64_decode($fileContent->content);

            // save into documents
            $Parsedown            = new Parsedown;

            // easy access variables
            $version_id = $request->input('version_id');
            $title   = str_replace('.md', '', $file->name);

            // check to see if we already have a document
            $document = Document::where('version_id', $version_id)->where('title', $title)->first();

            if($document) {
                $document->markdown   = $fileContent;
                $document->html       = $Parsedown->text($document->markdown);
                $document->save();
            } else {
                $document             = new Document;
                $document->version_id = $version_id;
                $document->title      = $title;
                $document->slug       = str_slug($document->title);
                $document->markdown   = $fileContent;
                $document->html       = $Parsedown->text($document->markdown);
                $document->save();
            }
        }

        return redirect()->back()->with('success', ['Successfully imported '. count($files) .' files into the version '. $version->tag]);
    }

}

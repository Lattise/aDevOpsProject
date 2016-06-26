<?php

namespace App\Http\Controllers;

use App\Jobs\Fire as FireJob;
use App\Fire as FireModel;
use Illuminate\Http\Request;
use Log;
use Storage;
use Queue;

class FireController extends Controller
{
    /**
     * @return array
     */
    public function index($project, Request $request)
    {
        $arg = ['project' => $project, 'func' => 'fire'];
        if ($request->get('version'))
            $arg['version'] = $request->get('version');
        return view('fire.fire', $arg);
    }

    public function execute($project, Request $request)
    {
        $version = $request->input('version');

        $fire_job = new FireJob($project, $version);

        $deploy_model = new FireModel();
        $deploy_model->id = $fire_job->id;
        $deploy_model->project = $project;
        $deploy_model->version = $version;
        $deploy_model->save();

        Queue::push($fire_job);

        return view('fire.result', [
            'project' => $project,
            'func' => 'fire',
            'version' => $version,
            'id' => $fire_job->id,
        ]);
    }
}

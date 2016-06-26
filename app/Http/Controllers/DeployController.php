<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy as DeployJob;
use App\Deploy as DeployModel;
use App\Sql;
use Illuminate\Http\Request;
use Log;
use PDO;
use PDOException;
use Storage;
use Queue;

class DeployController extends Controller
{
    public function index($project, Request $request)
    {
        $arg = ['project' => $project, 'func' => 'deploy'];
        if ($request->get('version'))
            $arg['version'] = $request->get('version');
        return view('deploy.deploy', $arg);
    }

    public function execute($project, Request $request)
    {
        $version = $request->input('version');

        $deploy_job = new DeployJob($project, $version);

        $deploy_model = new DeployModel();
        $deploy_model->id = $deploy_job->id;
        $deploy_model->project = $project;
        $deploy_model->version = $version;
        $deploy_model->save();

        Queue::push($deploy_job);

        return view('deploy.result', [
            'project' => $project,
            'func' => 'deploy',
            'version' => $version,
            'id' => $deploy_job->id,
        ]);
    }
}

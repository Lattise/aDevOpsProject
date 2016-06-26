<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobs\Deploy;
use App\Jobs\Exec;
use Illuminate\Http\Request;
use Queue;
use Log;
use Storage;

class JobController extends Controller
{
    public function index($project)
    {
        return view('job.job', ['project' => $project, 'func' => 'job']);
    }

    public function execute($project, Request $request)
    {
        $job = $request->input('job');
        $version = $request->input('version');

        $exec_job = new Exec($project, $job, $version);

        $job_model = new Job();
        $job_model->id = $exec_job->id;
        $job_model->project = $project;
        $job_model->job = $job;
        $job_model->version = $version;
        $job_model->save();

        Queue::push($exec_job);
        
        return view('job.result', [
            'project' => $project,
            'func' => 'job',
            'job' => $job,
            'version' => $version,
            'id' => (string)$exec_job->id,
        ]);
    }
}

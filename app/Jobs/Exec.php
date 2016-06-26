<?php

namespace App\Jobs;

use App\Project;
use Log;
use Symfony\Component\Process\Process;
use Ramsey\Uuid\Uuid;
use Storage;

class Exec extends Job
{
    public $id;
    private $cmd;

    public function __construct($project, $job_name, $version = 'current')
    {
        $this->id = Uuid::uuid4();
        $artisan_path = Project::where('name', $project)->lists('artisan_path')->first();
        if ($version != 'current')
            $version = 'releases/' . $version;
        $this->cmd = "ssh job0 \"/bin/bash -c 'cd /data/srv/$project/$version/ && php $artisan_path $job_name'\"";
    }

    /**
     * @return int
     */
    public function handle()
    {
        $job_id = (string)$this->id;
        Storage::append($job_id . ".log", '$' . $this->cmd);
        $process = new Process($this->cmd);
        $process->setTimeout(null);
        $process->run(function ($type, $buffer) use ($job_id) {
            $buffer = trim($buffer);
            Storage::append($job_id . ".log", $buffer);
        });

        Storage::append($job_id . ".log", 'Exit Code: ' . $process->getExitCode());
    }
}

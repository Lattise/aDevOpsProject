<?php

namespace App\Jobs;

use Illuminate\Contracts\Foundation\Application;
use Log;
use Symfony\Component\Process\Process;
use Ramsey\Uuid\Uuid;
use Storage;

class Fire extends Job
{
    public $id;
    private $cmd;

    public function __construct($project, $version)
    {
        $this->id = Uuid::uuid4();
        $this->cmd = "./venv/bin/python $project.py -F $version";
    }

    public function handle()
    {
        $job_id = (string)$this->id;
        Storage::append($job_id . ".log", '$' . $this->cmd);
        $process = new Process($this->cmd, env('ANGEL_PATH'), [
            'PATH' => env('PATH') . ":./venv/bin/",
            'HOME' => env('HOME'),
        ]);
        $process->setTimeout(600);
        $process->run(function ($type, $buffer) use ($job_id) {
            $buffer = trim($buffer);
            Storage::append($job_id . ".log", $buffer);
        });

        Storage::append($job_id . ".log", 'Exit Code: ' . $process->getExitCode());
    }
}

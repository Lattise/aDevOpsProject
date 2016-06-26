<?php

namespace App\Http\Controllers;

use App\Job;
use App\Jobs\Deploy;
use App\Jobs\Exec;
use Illuminate\Http\Request;
use Queue;
use Log;
use Storage;

class LogController extends Controller
{
    public function log($id)
    {
        $body = Storage::get($id . '.log');
        return response($body)
            ->header('Content-Type', 'text/plain');
    }
}

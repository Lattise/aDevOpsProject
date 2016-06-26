<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy;
use Illuminate\Http\Request;
use Log;
use Storage;

class ProjectController extends Controller
{
    /**
     * @return array
     */
    public function index($project)
    {
        return redirect(route('fire', ['project' => $project]));
    }
}

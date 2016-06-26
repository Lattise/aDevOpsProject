<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy;
use Illuminate\Http\Request;
use Log;
use Storage;

class HomeController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function index(Request $request)
    {
        return redirect(route('project', ['project' => 'angejia']));
    }
}

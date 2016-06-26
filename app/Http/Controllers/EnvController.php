<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy;
use App\Env;
use App\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Log;
use Storage;

class EnvController extends Controller
{
    /**
     * @return array
     */
    public function index($project)
    {
        $proj = Project::where('name', $project)->lists('id')->toArray();
        $envs = Env::whereIn('project', $proj)->get();
        return view('env', [
            'project' => $project,
            'func' => 'env',
            'envs' => $envs,
        ]);
    }

    public function patch($project, Request $request)
    {
        $id = $request->input('pk');
        $value = $request->input('value');
        $env = Env::find($id);
        $env->value = $value;
        $env->save();
        return new JsonResponse();
    }

    public function del($project, $id)
    {
        $env = Env::find($id);
        $env->delete();
        return new JsonResponse();
    }

    public function add($project, Request $request)
    {
        $proj = Project::where('name', $project)->lists('id')->toArray();
        $env = new Env;
        $env->project = (int)$proj;
        $env->key = $request->input('key');
        $env->value = $request->input('value');
        $env->save();
        return redirect(route('env', ['project' => $project]));
    }

    public function dump($project, $format)
    {
        $proj = Project::where('name', $project)->lists('id')->toArray();
        $envs = Env::whereIn('project', $proj)->get();
        if ($format == 'json') {
            $data = [];
            foreach ($envs as $env) {
                array_push($data, [
                    'id' => $env->id,
                    'key' => $env->key,
                    'value' => $env->value,
                ]);
            }
            return response()->json($data);
        } else {
            $body = '';
            foreach ($envs as $env) {
                $key = $env->key;
                $value = $env->value;
                $body .= "$key=$value";
                $body .= PHP_EOL;
            }
            return response($body)
                ->header('Content-Type', 'text/plain');
        }
    }
}

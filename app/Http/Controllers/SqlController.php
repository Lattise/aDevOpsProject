<?php

namespace App\Http\Controllers;

use App\Jobs\Deploy;
use App\Sql;
use Illuminate\Http\Request;
use Log;
use PDO;
use PDOException;
use Storage;

class SqlController extends Controller
{
    public function index($project)
    {
        return view('sql.sql', ['project' => $project, 'func' => 'sql']);
    }
    
    public function execute($project, Request $request)
    {
        $sql = $request->input('sql');
        $db_host = env('ONLINE_DB_HOST');
        $db_user = env('ONLINE_DB_USER');
        $db_pass = env('ONLINE_DB_PASS');
        $db = new PDO("mysql:host=$db_host;charset=utf8mb4", $db_user, $db_pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        try {
            $r = $db->query($sql);
            $message = 'affected row: ' . $r->rowCount();
            $success = true;
        } catch (PDOException $e) {
            $success = false;
            $message = $e->getMessage();
        }

        $sql_model = new Sql();
        $sql_model->sql = $sql;
        $sql_model->success = $success;
        $sql_model->save();

        return view('sql.result', [
            'project' => $project,
            'func' => 'sql',
            'sql' => $sql,
            'success' => $success,
            'message' => $message,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Project::firstOrCreate([
            'id' => 2,
            'name' => 'retrx-mgt',
            'repo_path' => 'service/retrx-mgt',
            'artisan_path' => 'artisan',
        ]);
    }

    public function data()
    {
        return [
            ['id' => 1, 'name' => 'angejia', 'repo_path' => 'service/retrx-mgt', 'artisan_path' => 'app-job/artisan'],
            ['id' => 2, 'name' => 'retrx-mgt', 'repo_path' => 'service/retrx-mgt', 'artisan_path' => 'artisan'],
            ['id' => 3, 'name' => 'account', 'repo_path' => 'service/retrx-mgt', 'artisan_path' => 'artisan'],
            ['id' => 4, 'name' => 'angejia', 'repo_path' => 'service/retrx-mgt', 'artisan_path' => 'artisan'],
        ];
    }
}

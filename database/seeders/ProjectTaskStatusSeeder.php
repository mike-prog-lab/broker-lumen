<?php

namespace Database\Seeders;

use App\Models\ProjectTaskStatus;
use Illuminate\Database\Seeder;

class ProjectTaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectTaskStatus::insert([
            [
                'name' => 'New',
            ],
            [
                'name' => 'In progress',
            ],
            [
                'name' => 'Done',
            ],
        ]);
    }
}

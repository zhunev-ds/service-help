<?php

use App\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusTableSeeder extends Seeder
{
    public function run()
    {
        $taskStatuses = [
            [
                'id'   => '1',
                'name' => 'Запланировано',
            ],
            [
                'id'   => '2',
                'name' => 'В работе',
            ],
            [
                'id'   => '3',
                'name' => 'Завершено',
            ],
        ];

        TaskStatus::insert($taskStatuses);
    }
}

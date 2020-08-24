<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Администратор',
            ],
            [
                'id'    => 2,
                'title' => 'Пользователь',
            ],
            [
                'id'    => 3,
                'title' => 'Оператор',
            ],
        ];

        Role::insert($roles);
    }
}

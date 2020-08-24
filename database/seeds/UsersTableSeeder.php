<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@orem.su',
                'password'       => '$2y$10$QgEPv8P3qIAW1ogHa/6G6uL9RmIN6I3GPBakY5poiNtEVpDHyWYIG',
                'remember_token' => null,
                'surname'        => 'Администратор',
                'patronymic'     => '',
                'position'       => '',
                'company'        => '',
                'phone'          => '',
            ],
            [
                'id'             => 2,
                'name'           => 'User',
                'email'          => 'user@orem.su',
                'password'       => '$2y$10$QgEPv8P3qIAW1ogHa/6G6uL9RmIN6I3GPBakY5poiNtEVpDHyWYIG',
                'remember_token' => null,
                'surname'        => 'Пользователь',
                'patronymic'     => '',
                'position'       => '',
                'company'        => '',
                'phone'          => '',
            ],
            [
                'id'             => 3,
                'name'           => 'Operator',
                'email'          => 'operator@orem.su',
                'password'       => '$2y$10$QgEPv8P3qIAW1ogHa/6G6uL9RmIN6I3GPBakY5poiNtEVpDHyWYIG',
                'remember_token' => null,
                'surname'        => 'Оператор',
                'patronymic'     => '',
                'position'       => '',
                'company'        => '',
                'phone'          => '',
            ],
        ];

        User::insert($users);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
               'name'=>'Admin',
               'email'=>'admin@admin.com',
                'is_admin'=>'1',
               'password'=> bcrypt('123456789'),
            ],
            [
               'name'=>'shazaraj',
               'email'=>'shaza@mail.com',
                'is_admin'=>'0',
               'password'=> bcrypt('123456789'),
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}

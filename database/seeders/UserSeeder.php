<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'username' => 'admin',
                'password' => bcrypt('admin123'),
                'isactive' => true,
            ],
            [
                'username' => 'teacher1',
                'password' => bcrypt('teacher123'),
                'isactive' => true,
            ],
            [
                'username' => 'staff1',
                'password' => bcrypt('staff123'),
                'isactive' => false,
            ],
        ]);
    }
}

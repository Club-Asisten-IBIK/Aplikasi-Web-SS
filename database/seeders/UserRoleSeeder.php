<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('userrole')->insert([
            [
                'userid' => 1,
                'roleid' => 1,
            ],
            [
                'userid' => 2,
                'roleid' => 2,
            ],
            [
                'userid' => 3,
                'roleid' => 3,
            ],
        ]);
    }
}

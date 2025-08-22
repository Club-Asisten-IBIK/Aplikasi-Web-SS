<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolYear::insert([
            [
                'schoolyear' => '2023/2024',
                'desc' => 'Tahun ajaran 2023/2024',
                'is_active' => 1,
            ],
            [
                'schoolyear' => '2024/2025',
                'desc' => 'Tahun ajaran 2024/2025',
                'is_active' => 0,
            ],
        ]);
    }
}

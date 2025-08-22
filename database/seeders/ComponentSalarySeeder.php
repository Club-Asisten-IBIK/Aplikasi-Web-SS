<?php

namespace Database\Seeders;

use App\Models\ComponentSalary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComponentSalarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ComponentSalary::insert([
            ['componentname' => 'Gaji Pokok'],
            ['componentname' => 'Tunjangan Transportasi'],
            ['componentname' => 'Tunjangan Makan'],
            ['componentname' => 'Bonus'],
        ]);
    }
}

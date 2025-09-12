<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('employees')->insert([
            [
                'nik'        => '10993',
                'nama'       => 'Muhammad Niko Dwijatmiko',
                'whatsapp'   => '082351442030',
                'password'   => bcrypt('10993'), // password sama dengan NIK
                'created_at' => $now,
                'updated_at' => $now,
            ]
		]);
    }
}

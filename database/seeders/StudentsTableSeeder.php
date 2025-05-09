<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('students')->insert([
            ['id' => 1, 'name' => 'John Doe', 'age' => 20],
            ['id' => 2, 'name' => 'Jane Smith', 'age' => 22],
        ]);
    }
}

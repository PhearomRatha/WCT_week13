<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('teachers')->insert([
            ['id' => 1, 'name' => 'Mr. Brown', 'subject' => 'Math'],
            ['id' => 2, 'name' => 'Ms. Green', 'subject' => 'Science'],
        ]);
    }
}

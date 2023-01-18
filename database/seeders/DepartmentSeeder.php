<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            'name' => 'Medicine'
        ]);
        DB::table('departments')->insert([
            'name' => 'Dental'
        ]);
        DB::table('departments')->insert([
            'name' => 'Phycology'
        ]);
        DB::table('departments')->insert([
            'name' => 'Phathology'
        ]);
    }
}

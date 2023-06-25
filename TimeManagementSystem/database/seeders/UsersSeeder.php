<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user')->insert([
            'username'=>'admin',
            'password'=>'admin',
            'f_name'=>'AFirstName',
            'l_name'=>'ALastName',
            'matrics'=>'A001',
            'role'=>'0',
        ]);

        DB::table('user')->insert([
            'username'=>'student',
            'password'=>'student',
            'f_name'=>'FirstName',
            'l_name'=>'LastName',
            'matrics'=>'P00000001',
            'role'=>'1',
        ]);
    }
}

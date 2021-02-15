<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name'      => 'admin',
            'email'     => 'admin@gmail.com',
            'user_type' => '1',
            'email_verified_at' =>  '2021-01-27 06:27:25',
            'password'  => Hash::make('admin'),
        ]);
    }
}

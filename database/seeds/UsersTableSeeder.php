<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'     =>  'admin@admin.com',
            'username'  =>  'admin',
            'password'  =>  bcrypt('123456')
        ]);
    }
}

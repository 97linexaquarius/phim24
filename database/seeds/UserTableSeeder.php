<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin'),
                'level' => 2,
            ],
            [
                'name' => 'superadmin',
                'email' => 'doanhoanganh1997@gmail.com',
                'password' => bcrypt('admin'),
                'level' => 1,
            ]
        ]);
    }
}

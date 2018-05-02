<?php

use Illuminate\Database\Seeder;

class MovieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('movie')->insert([
                [
                    'id_category' => 1,
                    'id_nation' => 1,
                    'name' => 'Chiến hạm',
                    'status' => 'Full HD',
                ],
                [
                    'id_category' => 2,
                    'id_nation' => 2,
                    'name' => 'Nhập cư',
                    'status' => 'CAM',
                ],
                [
                    'id_category' => 2,
                    'id_nation' => 3,
                    'name' => 'Di cư',
                    'status' => 'HD',
                ],
                [
                    'id_category' => 4,
                    'id_nation' => 2,
                    'name' => 'Thử thôi mà',
                    'status' => '2K',
                ],
                [
                    'id_category' => 1,
                    'id_nation' => 1,
                    'name' => 'Tàu thuyền',
                    'status' => '4K',
                ],
                [
                    'id_category' => 2,
                    'id_nation' => 4,
                    'name' => 'Shang',
                    'status' => 'Full HD',
                ]
            ]);
        }
    }
}

<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('category')->insert([
                [
                    'name' => 'Phim hành động',
                    'type' => '1',
                ],
                [
                    'name' => 'Phim hoạt hình',
                    'type' => '2',
                ],
                [
                    'name' => 'Phim khoa học viễn tưởng',
                    'type' => '1',
                ],
                [
                    'name' => 'Phim Việt Nam',
                    'type' => '2',
                ],
                [
                    'name' => 'Phim Hàn Quốc',
                    'type' => '2',
                ],
                [
                    'name' => 'Phim võ thuật',
                    'type' => '1',
                ]
            ]);
        }
    }
}

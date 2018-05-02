<?php

use Illuminate\Database\Seeder;

class NationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('nation')->insert([
                
                [
                    'name' => 'Nga ngố',
                   
                ],
                [
                    'name' => 'Việt Nam',
                    
                ],
                [
                    'name' => 'Hàn Quốc',
                   
                ],
                [
                    'name' => 'Mỹ',
                    
                ]
            ]);
        }
    }
}

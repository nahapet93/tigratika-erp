<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class SourcesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sources')->delete();

        DB::table('sources')->insert([
            0 => [
                'id' => 1,
                'name' => 'Производство',
                'created_at' => NULL,
                'updated_at' => NULL,
            ], 1 => [
                'id' => 2,
                'name' => 'Склад',
                'created_at' => NULL,
                'updated_at' => NULL,
            ],
        ]);
    }
}

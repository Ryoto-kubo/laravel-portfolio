<?php

use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            ['name' => 'PG'],
            ['name' => 'SG'],
            ['name' => 'SF'],
            ['name' => 'PF'],
            ['name' => 'C'],
        ]);
    }
}

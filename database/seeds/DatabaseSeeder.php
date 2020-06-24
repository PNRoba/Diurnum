<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         DB::table('public')->insert([
                  'id' => '1',
                  'status' => 'public',
         ]);
         DB::table('public')->insert([
                  'id' => '2',
                  'status' => 'private',
         ]);
    }
}

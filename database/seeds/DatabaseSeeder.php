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
         DB::table('users')->insert([
                  'id' => '1',
                  'name' => 'Admin',
                  'username' => 'Admin',
                  'email' => 'admin@admin.com',
                  'password' => bcrypt('secret123'),
                  'roles_id' => '1',
         ]);
    }
}

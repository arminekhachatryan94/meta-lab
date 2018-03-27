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
        DB::table('users')->delete();
        DB::table('users')->insert([
          'id'=> 1,
          'first_name' => 'Armine',
          'last_name' => 'Khachatryan',
          'email' => 'armine@my.csun.edu',
          'username' => 'armine',
          'password' => bcrypt('secret'),
          'role' => 'admin',
          'created_at' => now(),
          'remember_token' => str_random(10),
        ]);
    }
}

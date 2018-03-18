<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        DB::table('posts')->insert([
          'id' => 1,
          'user_id' => 1,
          'title' => 'New Post',
          'body' => 'First post is about MetaBlog'
        ]);
    }
}

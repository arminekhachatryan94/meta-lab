<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();
        DB::table('comments')->insert([
            'id' => 1,
            'post_id' => 1,
            'user_id' => 1,
            'body' => 'Nice post!',
            'created_at' => now()
        ]);
        DB::table('comments')->insert([
            'id' => 2,
            'post_id' => 1,
            'user_id' => 1,
            'body' => 'Love the post! Excited to use MetaBlog',
            'created_at' => now()
          ]);
    }
}

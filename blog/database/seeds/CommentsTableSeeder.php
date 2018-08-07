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
        DB::table('comments')->insert([
             'comment' => 'It is nice article!',
             'created_date' => '02/02/2018',
             'blog_id' => 1,
             'user_id' => 1
        ]);
        DB::table('comments')->insert([
            'comment' => 'Very interesting!',
            'created_date' => '02/02/2018',
            'blog_id' => 1,
            'user_id' => 1
        ]);
        DB::table('comments')->insert([
            'comment' => 'Very bad!',
            'created_date' => '22/06/2018',
            'blog_id' => 2,
            'user_id' => 2
        ]);
        DB::table('comments')->insert([
            'comment' => 'Wonderful!',
            'created_date' => '22/06/2018',
            'blog_id' => 2,
            'user_id' => 2
        ]);
        DB::table('comments')->insert([
            'comment' => 'With God!',
            'created_date' => '17/07/2018',
            'blog_id' => 3,
            'user_id' => 1
        ]);
    }
}

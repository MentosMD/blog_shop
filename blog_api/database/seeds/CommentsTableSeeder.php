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
             'name' => 'Mike',
             'email' => 'mike@gmail.com',
             'comment_body' => 'It is nice article!',
             'created_date' => '02/02/2018',
             'blog_id' => 1
        ]);
        DB::table('comments')->insert([
            'name' => 'Karl',
            'email' => 'karl@gmail.com',
            'comment_body' => 'Very interesting!',
            'created_date' => '02/02/2018',
            'blog_id' => 1
        ]);
        DB::table('comments')->insert([
            'name' => 'Josh',
            'email' => 'josh@gmail.com',
            'comment_body' => 'Very bad!',
            'created_date' => '22/06/2018',
            'blog_id' => 2
        ]);
        DB::table('comments')->insert([
            'name' => 'Aliona',
            'email' => 'aliona@gmail.com',
            'comment_body' => 'Wonderful!',
            'created_date' => '22/06/2018',
            'blog_id' => 2
        ]);
        DB::table('comments')->insert([
            'name' => 'Peter',
            'email' => 'peter@gmail.com',
            'comment_body' => 'With God!',
            'created_date' => '17/07/2018',
            'blog_id' => 3
        ]);
    }
}

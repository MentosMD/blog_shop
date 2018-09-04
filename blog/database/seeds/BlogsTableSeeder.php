<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog')->insert([
              'blog_title' => 'What Is the Bible?',
              'blog_body' => 'example',
              'user_id' => 1,
              'created_date' => '2018-02-02'
        ]);
        DB::table('blog')->insert([
            'blog_title' => 'Bible Facts',
            'blog_body' => 'example',
            'user_id' => 1,
            'created_date' => '2018-06-06'
        ]);
        DB::table('blog')->insert([
            'blog_title' => 'Who wrote the Bible?',
            'blog_body' => 'example',
            'user_id' => 2,
            'created_date' => '2018-08-07'
        ]);
    }
}

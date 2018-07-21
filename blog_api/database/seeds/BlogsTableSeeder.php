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
              'blog_author' => 'Admin',
              'created_date' => '02/02/2018'
        ]);
        DB::table('blog')->insert([
            'blog_title' => 'Bible Facts',
            'blog_body' => 'example',
            'blog_author' => 'Admin',
            'created_date' => '22/06/2018'
        ]);
        DB::table('blog')->insert([
            'blog_title' => 'Who wrote the Bible?',
            'blog_body' => 'example',
            'blog_author' => 'Admin',
            'created_date' => '17/07/2018'
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            'title' => 'Magic of Heroes 2',
            'description' => 'this is awesome!',
            'author' => 'Josh Kerem',
            'pages' => 244,
            'price' => 10
        ]);

        DB::table('books')->insert([
            'title' => 'Magic of Heroes 3',
            'description' => 'this is awesome!',
            'author' => 'Josh Kerem',
            'pages' => 344,
            'price' => 13
        ]);

        DB::table('books')->insert([
            'title' => 'Magic of Heroes 4',
            'description' => 'this is awesome!',
            'author' => 'Josh Kerem',
            'pages' => 284,
            'price' => 15.50
        ]);

        DB::table('books')->insert([
            'title' => 'First player ready',
            'description' => 'this is awesome!',
            'author' => 'Steve Spilberg',
            'pages' => 454,
            'price' => 20.50
        ]);

        DB::table('books')->insert([
            'title' => 'The Psychology',
            'description' => 'this is awesome!',
            'author' => 'Bert Narith',
            'pages' => 314,
            'price' => 17.00
        ]);

        DB::table('books')->insert([
            'title' => 'Human Psychology',
            'description' => 'this is awesome!',
            'author' => 'Sarabject Kaur',
            'pages' => 214,
            'price' => 12.00
        ]);

        DB::table('books')->insert([
            'title' => 'Psychology Major',
            'description' => 'this is awesome!',
            'author' => 'William Bussik',
            'pages' => 364,
            'price' => 24.00
        ]);

        DB::table('books')->insert([
            'title' => 'Games People Play',
            'description' => 'this is awesome!',
            'author' => 'Eric Berne',
            'pages' => 564,
            'price' => 21.00
        ]);

        DB::table('books')->insert([
            'title' => 'Positive Psychology',
            'description' => 'this is awesome!',
            'author' => 'Alex Liney',
            'pages' => 564,
            'price' => 21.00
        ]);

        DB::table('books')->insert([
            'title' => 'General Psychology',
            'description' => 'this is awesome!',
            'author' => 'Loreto V',
            'pages' => 524,
            'price' => 14.75
        ]);

        DB::table('books')->insert([
            'title' => 'Forensic Psychology',
            'description' => 'this is awesome!',
            'author' => 'David Mar',
            'pages' => 224,
            'price' => 13.55
        ]);
    }
}

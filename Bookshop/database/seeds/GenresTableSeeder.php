<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->insert([
           'GenreName' => 'Fantastic',
        ]);
        DB::table('genres')->insert([
            'GenreName' => 'Science',
        ]);
        DB::table('genres')->insert([
            'GenreName' => 'Dramatic',
        ]);
    }
}

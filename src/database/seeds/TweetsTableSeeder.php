<?php

use Illuminate\Database\Seeder;

class TweetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tweets')->insert([
            'text'=> '今日は風が冷たい',
            'user_id' => '100',
            'content_url'=> 'test',
        ]);
    }
}

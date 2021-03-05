<?php

use Illuminate\Database\Seeder;

class DeliversTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivers')->insert([
            'name'              => 'user',
            'email'             => 'user@example.com',
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ]);
    }
}
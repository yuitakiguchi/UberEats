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
            'phone_number'      => Hash::make('09022221111'),
            'email'             => 'user@example.com',
            'address'           => '東京都品川区',
            'password'          => Hash::make('12345678'),
            'remember_token'    => Str::random(10),
        ]);
    }
}

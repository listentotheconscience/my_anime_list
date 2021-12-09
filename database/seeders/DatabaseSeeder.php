<?php

namespace Database\Seeders;

use App\Models\Licensor;
use App\Models\Producer;
use App\Models\Studio;
use App\Nova\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpseclib3\Crypt\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Licensor::factory(50)->create();
        Studio::factory(50)->create();
        Producer::factory(50)->create();
        DB::table('users')->insert([[
            'email' => 'iseethatshitlikethesharingan@gmail.com',
            'name' => 'listentotheconscience',
            'password' => \Illuminate\Support\Facades\Hash::make('yourenottheonlyonetoblamehowthingsturnedout'),
            'image' => 'https://sun9-61.userapi.com/impg/I4EjGENimuDPrihSumJSDK4yfeq3zRb34ARl0Q/wzZPJ9MIQG4.jpg?size=1080x1080&quality=96&sign=e716966a259027d07286fce64a684207&type=album'
        ]]);
    }
}

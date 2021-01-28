<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        DB::table('users')->insert([
            'unique_id' => 'kjgsfhgjfl',
            'name' => 'Chibueze',
            'last_name' => 'Agbo',
            'user_type' => 'user',
            'email' => 'agbochibueze13@gmail.com',
            'user_referral_id' => 'fhkjdhfjk',
            'referred_id' => 'none',
            'password' => Hash::make('biggerguy'),
        ]);
    }
}

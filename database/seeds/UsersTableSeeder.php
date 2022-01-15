<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'              => 'user2',
            'email'             => 'user2@mail.com',
            'password'          => Hash::make('1234qwer'),
            'remember_token'    => Str::random(10),
        ]);
    }
}

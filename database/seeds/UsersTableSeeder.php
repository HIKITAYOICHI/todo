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
            [
            'name'              => 'userA',
            'email'             => 'userA@mail.com',
            'password'          => Hash::make('1234qwer'),
            'remember_token'    => Str::random(10),
            ],
            ['name'              => 'userB',
            'email'             => 'userB@mail.com',
            'password'          => Hash::make('1234qwer'),
            'remember_token'    => Str::random(10),
            ],
        ]);    
    }
}

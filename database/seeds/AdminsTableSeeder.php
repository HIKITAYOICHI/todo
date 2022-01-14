<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('1234qwer'),
            'remember_token' => Str::random(10),
            ]);
    }
}

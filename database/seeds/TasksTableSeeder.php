<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->insert([
            [
            'user_id' => 1,
            'title' => 'テスト',
            'body' => 'Taskテスト1',
            'created_at' => '2022-02-01',
            ],
            [
            'user_id' => 1,
            'title' => 'テスト',
            'body' => 'Taskテスト2',
            'created_at' => '2022-02-02',
            ],
            [
            'user_id' => 1,
            'title' => 'テスト',
            'body' => 'Taskテスト3',
            'created_at' => '2022-02-03',
            ],
            [
            'user_id' => 1,
            'title' => 'テスト２',
            'body' => 'Taskテスト4',
            'created_at' => '2022-02-04',
            ],
            [
            'user_id' => 1,
            'title' => 'テスト２',
            'body' => 'Taskテスト5',
            'created_at' => '2022-02-05',
            ],
            [
            'user_id' => 1,
            'title' => 'テスト２',
            'body' => 'Taskテスト6',
            'created_at' => '2022-02-06',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト1',
            'body' => 'Taskテスト1',
            'created_at' => '2022-02-07',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト2',
            'body' => 'Taskテスト2',
            'created_at' => '2022-02-08',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト3',
            'body' => 'Taskテスト3',
            'created_at' => '2022-02-09',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト4',
            'body' => 'Taskテスト4',
            'created_at' => '2022-02-10',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト5',
            'body' => 'Taskテスト5',
            'created_at' => '2022-02-11',
            ],
            [
            'user_id' => 2,
            'title' => 'titleテスト6',
            'body' => 'Taskテスト6',
            'created_at' => '2022-02-12',
            ],
            
        ]);
    }
}

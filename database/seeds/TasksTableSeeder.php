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
        DB::table('tasks')->delete();

        for ($i = 0; $i < 5; $i++) {
            DB::table('tasks')->insert([
                'title' => str_random(10),
            ]);
        }
    }
}

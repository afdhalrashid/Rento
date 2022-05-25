<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TodoTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// $users = TodoTitle::factory()->count(3)->create();
    	\App\Models\TodoTitle::factory(5)->create();
    }
}

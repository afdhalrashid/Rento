<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        \App\Models\TodoTitle::factory(5)
            ->has(\App\Models\Todo::factory()->count(3), 'tasks')
            ->create();
    }
}

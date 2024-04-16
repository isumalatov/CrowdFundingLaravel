<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        /*User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/

        $this->call(ProjectSeeder::class);
        $this->command->info('Projects table seeded');

        $this->call(CommentSeeder::class);
        $this->command->info('Comments table seeded');

        $this->call(ContributionSeeder::class);
        $this->command->info('Contributions table seeded');

        $this->call(RewardSeeder::class);
        $this->command->info('Rewards table seeded');


        
    }
}

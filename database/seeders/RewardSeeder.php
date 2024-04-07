<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtén todos los project_id de la tabla de proyectos
        $projectIds = DB::table('projects')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('rewards')->insert([
                'project_id' => $faker->randomElement($projectIds), // Selecciona un project_id aleatorio de la lista
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'required_funds' => $faker->randomFloat(2, 100, 10000),
                'stock' => $faker->numberBetween(1, 100),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
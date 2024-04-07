<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtén todos los user_id de la tabla de usuarios
        $userIds = DB::table('users')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('projects')->insert([
                'user_id' => $faker->randomElement($userIds), // Selecciona un user_id aleatorio de la lista
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'publication_date' => $faker->dateTimeBetween('-1 years', 'now'),
                'completion_date' => $faker->dateTimeBetween('now', '+1 years'),
                'required_funds' => $faker->randomFloat(2, 100, 10000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Obtén todos los user_id y project_id de las tablas de usuarios y proyectos
        $userIds = DB::table('users')->pluck('id')->toArray();
        $projectIds = DB::table('projects')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('comments')->insert([
                'user_id' => $faker->randomElement($userIds), // Selecciona un user_id aleatorio de la lista
                'project_id' => $faker->randomElement($projectIds), // Selecciona un project_id aleatorio de la lista
                'text' => $faker->paragraph,
                'comment_date' => $faker->dateTimeBetween('-1 years', 'now'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
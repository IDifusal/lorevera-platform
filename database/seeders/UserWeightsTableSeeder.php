<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserWeightsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            // Generar una fecha aleatoria dentro del último año
            $date = Carbon::now()->subDays(rand(0, 365))->format('Y-m-d');

            DB::table('user_weights')->insert([
                'user_id' => 1, // Asumiendo que tienes al menos un usuario en tu BD. Cambia según sea necesario.
                'date' => $date,
                'weight' => $faker->numberBetween(60, 100), // Generar un peso aleatorio entre 60 y 100
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NutritionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('recipes')->insert([
            [
                "plan" => "meat_plan",
                "goal" => "loss_weight",
                "calories" => 2000,
                "fat" => 50,
                "carbs" => 200,
                "protein" => 150,
                "ingredients" => "chicken breast, broccoli, brown rice, olive oil, salt, pepper"
            ],
            [
                "plan" => "meat_plan",
                "goal" => "gain_muscle",
                "calories" => 2500,
                "fat" => 60,
                "carbs" => 250,
                "protein" => 200,
                "ingredients" => "beef, sweet potato, green beans, butter, salt, pepper"
            ],
            [
                "plan" => "vegetarian_plan",
                "goal" => "loss_weight",
                "calories" => 1800,
                "fat" => 40,
                "carbs" => 180,
                "protein" => 130,
                "ingredients" => "tofu, quinoa, spinach, coconut oil, salt, pepper"
            ],
            [
                "plan" => "vegetarian_plan",
                "goal" => "gain_muscle",
                "calories" => 2300,
                "fat" => 50,
                "carbs" => 230,
                "protein" => 180,
                "ingredients" => "lentils, rice, kale, olive oil, salt, pepper"
            ]
        ]);
    }
}

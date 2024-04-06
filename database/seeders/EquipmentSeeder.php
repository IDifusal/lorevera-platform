<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('equipment')->insert([
            ["name" => "Dumbbell", "featured_image_url" => "http://app.lorevera.com/images/equipment/dumpbell.jpg"],
            ["name" => "Mat", "featured_image_url" => "http://app.lorevera.com/images/equipment/mat.jpg"]
        ]);    
    }
}

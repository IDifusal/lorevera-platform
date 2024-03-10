<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {    
        $timestamps = date('Y-m-d H:i:s');

        DB::table('users')->insert([
            'name' => 'Difusal',
            'email' => 'difusal115@gmail.com',
            'isadmin'=>1,
            'created_at'=>$timestamps,
            'password' => Hash::make('libre123')
        ]);
        DB::table('users')->insert([
            'name' => 'Lore Vera',
            'email' => 'lorex@gmail.com',
            'isadmin'=>1,
            'created_at'=>$timestamps,
            'password' => Hash::make('loreveraFIT')
        ]);

        $this->call([
            UserWeightsTableSeeder::class,
            EquipmentSeeder::class
        ]);
    }
}

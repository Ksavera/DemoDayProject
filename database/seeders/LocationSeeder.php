<?php

namespace Database\Seeders;

use App\Models\Location;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            "Vilnius",
            "Kaunas",
            "Klaipėda",
            "Šiauliai",
            "Panevėžys",
            "Alytus",
            "Marijampolė",
            "Mazeikiai",
            "Jonava",
            "Utena",
            "Kėdainiai",
            "Telšiai",
            "Visaginas",
            "Tauragė",
            "Ukmergė",
            "Plungė",
            "Šilutė",
            "Kretinga",
            "Radviliškis",
            "Palanga",
            "Neringa",
        ];

        foreach ($locations as $location) {
            Location::create(['name' => $location]);
        }
    }
}

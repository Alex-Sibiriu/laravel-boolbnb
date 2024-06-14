<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\House;
use App\Models\Service;

class HouseServiceTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $house = House::inRandomOrder()->first();

            $service_id = Service::inRandomOrder()->first()->id;

            if (!$house->services()->where('service_id', $service_id)->exists()) {
                $house->services()->attach($service_id);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper as Help ;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = json_decode(file_get_contents('database/data/services.json'));
        foreach ($services as $service) {
            $new_service= new Service();
            $new_service->name=$service->name;
            $new_service->slug=Help::generateSlug($service->name, Service::class);
            $new_service->icon=$service->icon;
            $new_service->img=$service->img;
            $new_service->description=$service->description;
            $new_service->save();
        }
    }
}

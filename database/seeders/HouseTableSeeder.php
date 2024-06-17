<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\House;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $castles = json_decode(file_get_contents('database/data/houses.json'));

        $users = User::all();

        foreach ($castles as $castle) {
            $new_castle = new House();
            $new_castle->title = $castle->title;
            $new_castle->slug = Helper::generateSlug($castle->title, House::class);
            $new_castle->rooms = $castle->rooms;
            $new_castle->bathrooms = $castle->bathrooms;
            $new_castle->bed = $castle->bed;
            $new_castle->square_meters = $castle->square_meters;
            $new_castle->description = $castle->description;
            $new_castle->latitude = $castle->latitude;
            $new_castle->longitude = $castle->longitude;
            $new_castle->address = Helper::reverseGeocode($castle->latitude, $castle->longitude);

            $randomUser = $users->random()->id;
            $new_castle->user_id = $randomUser;

            $new_castle->save();
        }
    }
}

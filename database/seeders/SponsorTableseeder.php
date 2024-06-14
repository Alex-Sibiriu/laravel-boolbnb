<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper as Help;

class SponsorTableseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsor = json_decode(file_get_contents('database/data/sponsors.json'));



        foreach($sponsor as $item){
            $new_item = new Sponsor();
            $new_item->name = $item->name;
            $new_item->slug = Help::generateSlug($item->name, Sponsor::class);
            $new_item->duration = $item->duration;
            $new_item->price = $item->price;

            $new_item->save();
        }
    }
}

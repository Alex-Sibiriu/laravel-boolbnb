<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Image;

class ImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $images= json_decode(file_get_contents('database/data/images.json'));
       foreach ($images as $image) {
        $new_image= new Image();
        $new_image->house_id=$image->house_id;
        $new_image->image_path=$image->image_path;
        $new_image->type=$image->type;
        $new_image->save();

       }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages=json_decode(file_get_contents('database/data/messages.json'));

        foreach ($messages as $message) {
            $new_message= new Message();
            $new_message->message=$message->message;
            $new_message->email=$message->email;
            $new_message->house_id=$message->house_id;
            $new_message->save();
        }
    }
}

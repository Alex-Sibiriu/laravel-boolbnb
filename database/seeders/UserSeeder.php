<?php

namespace Database\Seeders;

use App\Functions\Helper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Functions\Helper as Help ;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
               'name' => 'Emiliana',
               'surname' => 'Manzo',
               'email' => 'emy@emy.it',
               'password' => 'ciao1234',
               'phone_number' => '3333333333',
               'birth_date' => '1996-10-01',
            ],
            [
               'name' => 'Alex',
               'surname' => 'Sibiriu',
               'email' => 'alex@alex.it',
               'password' => 'ciao1234',
               'phone_number' => '3333333333',
               'birth_date' => '1994-05-28',
            ],
            [
               'name' => 'Alessandro',
               'surname' => 'Moroni',
               'email' => 'ale@ale.it',
               'password' => 'ciao1234',
               'phone_number' => '3333333333',
               'birth_date' => '1998-08-13',
            ],
            [
               'name' => 'Davide',
               'surname' => 'Fois',
               'email' => 'davi@davi.it',
               'password' => 'ciao1234',
               'phone_number' => '3333333333',
               'birth_date' => '1996-01-12',
            ],
            [
               'name' => 'Dario',
               'surname' => 'Bennardino',
               'email' => 'dario@dario.it',
               'password' => 'ciao1234',
               'phone_number' => '3333333333',
               'birth_date' => '1986-05-21',
            ],
        ];

        foreach ($users as $user) {
            $new_user = new User();
            $new_user->name = $user['name'];
            $new_user->surname = $user['surname'];
            $new_user->slug = Help::generateSlug($user['name'] . $user['surname'], User::class);
            $new_user->email = $user['email'];
            $new_user->password = Hash::make($user['password']);
            $new_user->phone_number = $user['phone_number'];
            $new_user->birth_date = $user['birth_date'];
            $new_user->save();
        }
    }
}

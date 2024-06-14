<?php

namespace Database\Seeders;

use App\Models\House;
use App\Models\Sponsor;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseSponsorTableSeeder extends Seeder
{
    public function run()
    {
        // Loop per creare 10 relazioni casuali tra case e sponsor
        for ($i = 0; $i < 10; $i++) {

            // Trova una casa in modo casuale
            $house = House::inRandomOrder()->first();

            // Controlla se la casa ha già uno sponsor
            $hasAnySponsor = $house->sponsors()->exists();

            // Calcola le date di inizio e di scadenza
            if (!$hasAnySponsor) {
                // Se non ci sono sponsor precedenti per questa casa
                $start_date = Carbon::now();
            } else {
                // Se ci sono sponsor precedenti, usa la data di scadenza più recente
                $latest_expiration_date = $house->sponsors()->max('expiration_date');
                $start_date = Carbon::parse($latest_expiration_date)->addSecond(); // Aggiungi 1 secondo dopo l'ultima scadenza
            }

            // Trova uno sponsor in modo casuale
            $sponsor = Sponsor::inRandomOrder()->first();

            // Calcola la data di scadenza aggiungendo la durata dello sponsor in ore
            $expiration_date = $start_date->copy()->addHours($sponsor->duration);

            // Inserisci nella tabella pivot
            DB::table('house_sponsor')->insert([
                'house_id' => $house->id,
                'sponsor_id' => $sponsor->id,
                'start_date' => $start_date,
                'expiration_date' => $expiration_date,
            ]);
        }
    }
}

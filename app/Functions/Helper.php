<?php

namespace App\Functions;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class Helper
{
    public static function generateSlug($string, $model)
    {
        $slug = Str::slug($string, '-');
        $original_slug = $slug;

        $exist = $model::where('slug', $slug)->first();

        $count = 1;

        while ($exist) {
            $slug = $original_slug . '-' . $count;
            $exist = $model::where('slug', $slug)->first();
            $count++;
        }

        return $slug;
    }


    public static function formatDate($data)
    {

        $date = date_create($data);
        return date_format($date, 'd/m/Y');
    }

    public static function formatDateandTime($data)
    {

        $date = date_create($data);
        return date_format($date, 'd/m/Y H:i:s');
    }


    public static function reverseGeocode($latitude, $longitude)
    {
        // La mia API key
        $apiKey = env('TOMTOM_API_KEY');

        // Percorso del file cacert.pem (serve per i permessi , dei certificati)
        $cacertPath = env('CACERT_PEM_PATH');

        // Configura il client GuzzleHttp
        $client = new Client([
            'base_uri' => 'https://api.tomtom.com/',
            'verify' => $cacertPath,
        ]);

        // Eseguo la chiamata API
        $response = $client->get("search/2/reverseGeocode/{$latitude},{$longitude}.json", [
            'query' => ['key' => $apiKey]
        ]);


        // Verifico lo stato della risposta
        if ($response->getStatusCode() != 200) {
            return 'Errore: ' . $response->getStatusCode();
        }

        $data = json_decode($response->getBody(), true);
        $address = $data['addresses'][0]['address']['freeformAddress'] ?? 'Nessun indirizzo corrispondente';

        return $address;
    }
}

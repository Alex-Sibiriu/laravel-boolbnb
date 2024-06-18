<?php

namespace App\Functions;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class Helper
{
    public static function generateSlug($string, $model)
    {
        $slug = Str::of($string)->slug('-');
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


    public static function reverseGeocode($latitude, $longitude)
    {
        // La mia API key
        $apiKey = env('TOMTOM_API_KEY');

        // Percorso del file cacert.pem
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
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getBody(), true);
            if (isset($data['addresses']) && count($data['addresses']) > 0 && isset($data['addresses'][0]['address']['freeformAddress'])) {
                return $data['addresses'][0]['address']['freeformAddress'];
            } else {
                return 'Nessun indirizzo corrispondente';
            }
        } else {
            return 'Errore: ' . $response->getStatusCode();
        }
    }
}

<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class TomTomController extends Controller
{
    public function autocomplete(Request $request)
    {
        $cacertPath = realpath(base_path(env('CACERT_PEM_PATH')));
        $client = new Client([
            'base_uri' => 'https://api.tomtom.com/',
            'verify' => $cacertPath,
        ]);

        $query = $request->input('query');

        $response = $client->get('search/2/search/' . urlencode($query) . '.json', [
            'query' => [
                'key' => env('TOMTOM_API_KEY'),
                'typeahead' => 'true',
                'language' => 'it-IT',
                'countrySet' => 'IT',
                'limit' => 10
            ]
        ]);

        $data = json_decode($response->getBody(), true);
        return response()->json($data['results']);
    }
}

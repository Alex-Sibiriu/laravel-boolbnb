<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\House;
use App\Models\Message;
use App\Models\Service;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HousesController extends Controller
{
    public function index()
    {
        $houses = House::with('user', 'messages', 'images', 'services', 'sponsors')->paginate(12);
        return response()->json($houses);
    }

    public function getNearbyCastles($address, $radius = 100)
    {
        // Chiamata all'API di TomTom per ottenere le coordinate geografiche
        $cacertPath = env('CACERT_PEM_PATH');
        $client = new Client([
            'base_uri' => 'https://api.tomtom.com/',
            'verify' => $cacertPath,
        ]);

        $response = $client->get('search/2/geocode/' . urlencode($address) . '.json', [
            'query' => [
                'key' => env('TOMTOM_API_KEY')
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        if (empty($data['results'])) {
            return response()->json(['error' => 'Address not found'], 404);
        }

        $position = $data['results'][0]['position'];
        $latitude = $position['lat'];
        $longitude = $position['lon'];

        // Cerco i castelli entro il range specificato
        $houses = House::selectRaw(
            "*, ( 6371 * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance",
            [$latitude, $longitude, $latitude]
        )
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();

        return response()->json($houses);
    }

    public function getServices(){
        $services = Service::get();
        return response()->json($services);
    }
}

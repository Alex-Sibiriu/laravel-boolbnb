<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\House;
use App\Models\Service;
use App\Models\Sponsor;
use App\Models\Image;
use App\Functions\Helper;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Request\HouseRequest;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::where('user_id', Auth::user()->id)->paginate(5);
        return view('admin.houses.index', compact('houses'));
    }

    /**
     * Show the form for creating a new resource.
     */
   public function create()
{
    $method = 'POST';
    $route = route('admin.houses.store');
    $house = null;
    $title = 'Aggiungi un nuovo Castello';
    $services = Service::all();
    $button = 'Crea';

    return view('admin.houses.create-edit', compact('services', 'method', 'route', 'title', 'house', 'button'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(HouseRequest $request)
    {
        $val_data = $request->all();
        $val_data['user_id'] = Auth::user()->id;
        $val_data['slug'] = Helper::generateSlug($val_data['title'], House::class);

        $house = new House();
        $house->fill($val_data);
        $house->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'image_path' => $path,
                    'type' => $request->input('types')[$key],
                    'house_id' => $house->id,
                ]);
            }
        }

        return redirect()->route('admin.houses.show', compact('house'))->with('success', 'La casa è stata creata');
        // aggiungere i servizi col with
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        // Carica anche le immagini associate al castello
        $house->load('images');

        return view('admin.houses.show', compact('house'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {
        $method = 'PUT';
        $route = route('admin.houses.update', $house);
        $title = 'Modifica i dati del Castello: ' . $house->title ;
        $services = Service::all();
        $button = 'Aggiorna';


        return view('admin.houses.create-edit', compact('house', 'services', 'method', 'route', 'title', 'button'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HouseRequest $request, House $house)
    {
        $val_data = $request->all();
        $val_data['user_id'] = Auth::user()->id;
        $val_data['slug'] = Helper::generateSlug($val_data['title'], House::class);

        $house->update($val_data);

        if ($request->hasFile('images')) {
            // Elimina le vecchie immagini se necessario
            foreach ($house->images as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }

            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('images', 'public');
                Image::create([
                    'image_path' => $path,
                    'type' => $request->input('types')[$key],
                    'house_id' => $house->id,
                ]);
            }
        }

        return redirect()->route('admin.houses.show', compact('house'))->with('update', 'La casa è stata aggiornata');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();
        return redirect()->route('admin.houses.index')->with('deleted', 'La casa'. ' ' . $house->title. ' ' .'è stata cancellata con successo!');
    }
}

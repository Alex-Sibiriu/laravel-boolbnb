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
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (isset($_GET['toSearch'])) {
            $houses = House::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')
                ->where('user_id', Auth::id())->paginate(5);
            $count_search = House::where('title', 'LIKE', '%' . $_GET['toSearch'] . '%')
                ->where('user_id', Auth::id())->count();
        } else {

            $houses = House::where('user_id', Auth::user()->id)->paginate(5);
            // vogliamo contare tutti i risultati ?
            $count_search = House::count();
        }

        $direction = 'asc';

        return view('admin.houses.index', compact('houses', 'direction', 'count_search'));
    }

    // funzione rotta custom per cambiare l'ordine di visualizzazione
    public function orderBy($direction, $column)
    {
        $direction = $direction === 'desc' ? 'asc' : 'desc';
        $houses = House::where('user_id', Auth::id())->orderBy($column, $direction)->paginate(5);

        return view('admin.houses.index', compact('houses', 'direction'));
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
        $services = Service::orderBy('name')->get();
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

        if (array_key_exists('services', $val_data)) {
            $house->services()->attach($val_data['services']);
        }

        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $key => $image) {

                // La prima immagine sarà type 'cover', le altre type 'thumb'
                $type = $key === 0 ? 'cover' : 'thumb';


                $imagePath = $image->store('images', 'public');

                // Creazione dell'immagine nel database

                $house->images()->create([
                    'image_path' => $imagePath,
                    'type' => $type,
                ]);
            }
        }

        return redirect()->route('admin.houses.show', compact('house'))->with('success', 'Il castello è stato creato');
        // aggiungere i servizi col with
    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        if (Auth::id() !== $house->user_id) {
            abort('404');
        }
        // Carica anche le immagini associate al castello
        $house->load('images');

        $house = House::with(['sponsors' => function($query) {
            $query->where('expiration_date', '>=', Carbon::now());
        }])->findOrFail($house->id);
        return view('admin.houses.show', compact('house'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(House $house)
    {

        if (Auth::id() !== $house->user_id) {
            abort('404');
        }
        // dd($house);
        $method = 'PUT';
        $route = route('admin.houses.update', $house);
        $title = 'Modifica i dati del Castello: ' . $house->title;
        $services = Service::orderBy('name')->get();
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
    $val_data['address'] = Helper::reverseGeocode($val_data['latitude'], $val_data['longitude']);

    $house->update($val_data);

    if (array_key_exists('services', $val_data)) {
        $house->services()->sync($val_data['services']);
    } else {
        $house->services()->detach();
    }

    // Gestione immagini
    $existingImages = $house->images->pluck('id')->toArray();
    $newImages = $request->file('images') ?? [];

    // Rimozione delle immagini selezionate per l'eliminazione
    if ($request->has('remove_images')) {
        $imagesToRemove = explode(',', $request->input('remove_images'));
        foreach ($imagesToRemove as $imageId) {
            if (in_array($imageId, $existingImages)) {
                $image = Image::find($imageId);
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }
        }
    }

    // Controllo se esiste già una cover
    $hasCover = $house->images()->where('type', 'cover')->exists();

    // Aggiunta delle nuove immagini
    foreach ($newImages as $key => $image) {
        // Se c'è già una cover, tutte le nuove immagini saranno thumb
        $type = $hasCover ? 'thumb' : ($key === 0 ? 'cover' : 'thumb');
        if ($type === 'cover') $hasCover = true;

        $path = $image->store('images', 'public');

        Image::create([
            'image_path' => $path,
            'house_id' => $house->id,
            'type' => $type,
        ]);
    }

    return redirect()->route('admin.houses.index')->with('success', 'House updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();
        return redirect()->route('admin.houses.index')->with('deleted', 'Il castello' . ' ' . $house->title . ' ' . 'è stato cancellato con successo!');
    }

    public function deleted()
    {
        $houses = House::onlyTrashed()->where('user_id', Auth::id())->get();
        return view('admin.houses.deleted', compact('houses'));
    }

    public function retrieve($id)
    {

        $house = House::onlyTrashed()->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $house->restore();

        return redirect()->route('admin.houses.index')->with('deleted', 'Il castello ' . $house->title . ' è stato ripristinato');
        // non lo recupera veramente
    }
    public function stats(House $house){

        if (Auth::id() !== $house->user_id) {
            abort('404');
        }

       $house= House::where('slug',$house->slug)->get();

       return view('admin.houses.stats', compact('house'));
    }

}

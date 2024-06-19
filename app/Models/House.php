<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class House extends Model
{
    use HasFactory;

    // per utilizzare la soft delete e non l'hard delete
    use SoftDeletes;


    protected static function boot()
    {
        parent::boot();

        // static::deleting(function ($house) {
        //     // Elimina le immagini associate
        //     foreach ($house->images as $image) {
        //         // Elimina il file dal storage
        //         Storage::delete('public/' . $image->image_path);
        //         // Elimina il record dal database
        //         $image->delete();
        //     }
        // });
    }

    // funzione per far apparire lo slug nella url al posto dell'id
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    public function sponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    protected $fillable = [
        'title',
        'slug',
        'rooms',
        'bathrooms',
        'bed',
        'square_meters',
        'description',
        'address',
        'latitude',
        'longitude',
        'user_id',
        'is_visible',
    ];
}

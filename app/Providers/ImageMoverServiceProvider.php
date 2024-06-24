<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class ImageMoverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->moveImages();
    }

    /**
     * Register any application services.
     *
     * @return void
    */
    public function register()
    {
        //
    }

    protected function moveImages()
    {
        $sourcePath = public_path('castleImages');
        $destinationPath = public_path('storage/images');

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $files = File::files($sourcePath);

        foreach ($files as $file) {
            $destinationFilePath = $destinationPath . '/' . $file->getFilename();

            // Controlla se il file esiste già nella destinazione
            if (!File::exists($destinationFilePath)) {
                File::copy($file->getPathname(), $destinationFilePath);
            }
        }
    }
}

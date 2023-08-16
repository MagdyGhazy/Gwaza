<?php

namespace App\Providers;

use App\Models\Governorate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!app()->runningInConsole()) {
            $egyptianGovernorates = [
                "Cairo", "Alexandria", "Port Said", "Suez", "Ismailia", "Giza", "Gharbia", "Dakahlia", "Menoufia", "Beheira", "Kafr El Sheikh", "Sharkia", "Damietta", "Qalyubia", "Monufia", "Fayoum", "Beni Suef", "Minya",
                "Asyut", "Sohag", "Qena", "Luxor", "Aswan", "Red Sea", "Matrouh", "New Valley (Al Wadi al-Jadid)", "North Sinai (Shamal Sina)"
            ];

            foreach ($egyptianGovernorates as $governorateName) {
                  Governorate::create(['name' => $governorateName]);
            }

            view()->share('egyptianGovernorates',$egyptianGovernorates);
        }
    }
}

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
                "Cairo", "Alexandria", "Port Said", "Suez", "Ismailia", "Giza", "Gharbia (El Gharbia)", "Dakahlia (Dakahlia)", "Menoufia (Menoufia)", "Beheira (Beheira)", "Kafr El Sheikh", "Sharkia (Ash Sharqia)", "Damietta (Damietta)", "Qalyubia (Qalyubia)", "Monufia (Monufia)", "Fayoum (Faiyum)", "Beni Suef (Bani Suwayf)", "Minya (Minya)",
                "Asyut (Assiut)", "Sohag (Suhaj)", "Qena (Qina)", "Luxor (Al Uqsur)", "Aswan (Aswan)", "Red Sea (Sahel al-Bahr al-Ahmar)", "Matrouh (Matruh)", "New Valley (Al Wadi al-Jadid)", "North Sinai (Shamal Sina)"
            ];

            foreach ($egyptianGovernorates as $governorateName) {
                  Governorate::create(['name' => $governorateName]);
            }

            view()->share('egyptianGovernorates',$egyptianGovernorates);
        }
    }
}

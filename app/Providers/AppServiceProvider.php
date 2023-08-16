<?php

namespace App\Providers;

use App\Models\Governorate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
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


            App::singleton('governorates_jsonData', function() {

                $governorates_path = public_path('assets/json/governorates.json');
                $governorates_contents = file_get_contents($governorates_path);
                $governorates_jsonData = json_decode($governorates_contents, true);
                return$governorates_jsonData;

            });

            App::singleton('cities_jsonData', function() {

                $cities_path = public_path('assets/json/cities.json');
                $cities_contents = file_get_contents($cities_path);
                $cities_jsonData = json_decode($cities_contents, true);
                return$cities_jsonData;

            });

        }



    }
}

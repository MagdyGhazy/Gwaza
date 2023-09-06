<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocationController extends Controller
{
    public function governorates()
    {
        $governorates_data = App::make('governorates_jsonData');
        return $governorates_data;
    }
    public function cities($id)
    {
        $cities = App::make('cities_jsonData');
        $foundCity = [];
        foreach ($cities as $city) {
            if ($city['governorate_id'] == $id) {
                $foundCity[] = $city;
            }
        }
        return $foundCity;
    }
}

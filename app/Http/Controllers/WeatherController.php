<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class WeatherController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('weather.index', compact('cities'));
    }
}

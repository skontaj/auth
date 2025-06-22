<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.index', compact('cities'));
    }

    public function create()
    {
        return view('admin.cities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => [
                'required',
                'string',
                'max:255',
                'in:' . implode(',', timezone_identifiers_list()),
            ],
            'temperature' => 'required|integer|min:-50|max:60',
        ]);

        City::create($request->all());

        return redirect()->route('admin.cities.create')->with('success', 'City added!');
    }

    public function show(City $city)
    {
        return view('admin.cities.show', compact('city'));
    }

    public function edit(City $city)
    {
        return view('admin.cities.edit', compact('city'));
    }

    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'timezone' => [
                'required',
                'string',
                'max:255',
                'in:' . implode(',', timezone_identifiers_list()),
            ],
            'temperature' => 'required|integer|min:-50|max:60',
        ]);

        $city->update($request->all());

        return redirect()->route('admin.cities.index')->with('success', 'City updated!');
    }

    public function destroy(City $city)
    {
        $city->delete();
        return redirect()->route('admin.cities.index')->with('success', 'City deleted!');
    }
}

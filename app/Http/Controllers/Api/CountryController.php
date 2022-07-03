<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CountryController extends Controller
{
    public function syncAllCountriesToDatabase()
    {
        $countries = Http::get('https://countriesnow.space/api/v0.1/countries/population')->json()['data'];
        foreach ($countries as $country) {
            if (isset($country['code'])) {
                $updatedCountry = Country::updateOrCreate(
                    ['country_code' => $country['code']],
                    ['country_code' => $country['code'], 'country_name' => $country['country']],
                );
            }
        }
        return response([
            $countries
        ], 200);
    }

    public function index()
    {
        return response()->json(Country::all());
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}

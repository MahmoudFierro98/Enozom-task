<?php

namespace App\Repository;

use App\Models\Country;
use App\Repository\ICountryRepository;
use App\Services\CountryService;

class CountryRepository implements ICountryRepository
{
    public function getAllCountries()
    {
        return Country::all();
    }

    public function getCountriesPaging($perPage, $currentPage)
    {
        return Country::paginate($perPage, ['*'], 'page', $currentPage);
    }

    public function createOrUpdate($id = null, $name)
    {
        return (Country::updateOrCreate(
            ['country_code' => $id],
            ['country_code' => $id, 'country_name' => $name],
        ));
    }

    public function getCountry($id = null)
    {
        return Country::where('id', $id)->get()->first();
    }
}

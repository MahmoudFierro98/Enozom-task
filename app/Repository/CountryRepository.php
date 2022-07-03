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

    public function getCountriesPaging($pageSize, $page)
    {
        return Country::paginate($pageSize, ['*'], 'page', $page);
    }

    public function createOrUpdate($code = null, $name)
    {
        return (Country::updateOrCreate(
            ['country_code' => $code],
            ['country_code' => $code, 'country_name' => $name],
        ));
    }

    public function getCountry($id = null)
    {
        return Country::where('id', $id)->get()->first();;
    }
}

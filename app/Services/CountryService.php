<?php

namespace App\Services;

use App\Repository\CountryRepository;
use Illuminate\Support\Facades\Http;

class CountryService
{
    private CountryRepository $countryRepository;
    
    public function __construct()
    {
        $this->countryRepository = new CountryRepository();
    }

    public function syncCountriesToDataBase()
    {
        $countries = Http::get('https://countriesnow.space/api/v0.1/countries/population')->json();
        foreach ($countries as $country) {
            if (isset($country['code'])) {
                $updatedCountry = $this->country->createOrUpdate($country['code'], $country['country']);
            }
        }
        return response([
            'message' => 'Countries have been created/updated'
        ], 200);
    }

    public function getAllCountries()
    {
        $countries = $this->countryRepository->getAllCountries();
        return response($countries, 200);
    }

    public function getPagedCountries($perPage, $currentPage)
    {
        $countries = $this->country->getCountriesPaging($perPage, $currentPage);
        return response($countries, 200);
    }
}
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
        // $countries = Http::get('https://countriesnow.space/api/v0.1/countries/population')->json()['data'];
        $countries = Http::get($_ENV['API_COUNTRIES'])->json()['data'];
        foreach ($countries as $country) {
            if (isset($country['code'])) {
                $updatedCountry = $this->countryRepository->createOrUpdate($country['code'], $country['country']);
            }
        }
        return response([
            'done' => 'Countries have been created/updated'
        ], 200);
    }

    public function getAllCountries()
    {
        $countries = $this->countryRepository->getAllCountries();
        return response($countries, 200);
    }

    public function getCountriesPaging($pageSize, $page)
    {
        $countries = $this->countryRepository->getCountriesPaging($pageSize, $page);
        return response($countries, 200);
    }
}
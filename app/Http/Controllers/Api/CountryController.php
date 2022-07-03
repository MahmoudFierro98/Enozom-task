<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private CountryService $countryService;
    public function __construct()
    {
        $this->countryService = new CountryService();
    }

    public function syncCountriesToDataBase()
    {
        $this->countryService->syncCountriesToDataBase();
    }

    public function getAllCountries()
    {
        return $this->countryService->getAllCountries();
    }

    public function getAllCountriesPaging($perPage, $currentPage)
    {
        return $this->countryService->getPagedCountries($perPage, $currentPage);
    }
}

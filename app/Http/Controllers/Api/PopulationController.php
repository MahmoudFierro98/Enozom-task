<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Population;
use App\Services\PopulationService;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    private PopulationService $PopulationService;

    public function __construct()
    {
        $this->PopulationService = new PopulationService();
    }

    public function syncCountriesToDataBase(){
        return $this->PopulationService->syncCountriesToDataBase();
    }

    public function getPopulationOfCountry($countryId){
        return $this->PopulationService->getPopulationOfCountry($countryId);
    }

    public function getCountryWithMaxPopulationLastYear(){
        return $this->PopulationService->getCountryWithMaxPopulation();
    }

    public function getCountryWithMinPopulationLastYear(){
        return $this->PopulationService->getCountryWithMinPopulation();
    }
}

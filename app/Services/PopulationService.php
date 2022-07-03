<?php

namespace App\Services;

use App\Models\Population;
use App\Repository\CountryRepository;
use App\Repository\PopulationRepository;
use Illuminate\Support\Facades\Http;

class PopulationService
{
    private PopulationRepository $population;
    private CountryRepository $countryRepository;

    public function __construct()
    {
        $this->populationRepository = new PopulationRepository();
        $this->countryRepository = new CountryRepository();
    }

    public function syncCountriesToDataBase()
    {
        $countries = $this->countryRepository->getAllCountries();
        $allPopulations = Http::get($_ENV['API_COUNTRIES'])->json()['data'];
        foreach ($countries as $country) {
            foreach ($allPopulations as $population) {
                if ($population['code'] == $country['country_code'] && isset($population['populationCounts'])) {
                    foreach ($population['populationCounts'] as $populationCount) {
                        $updatedPopulation = $this->populationRepository->createOrUpdate($population['code'], $populationCount['year'], $populationCount['value'], $country['id']);
                    }
                }
            }
        }
        return response([
            'done' => 'Populations has been created/updated',
        ], 200);
    }

    public function getPopulationOfCountry($countryId)
    {
        $population = $this->populationRepository->getPopulation($countryId);
        return $population;
    }
}

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

    public function syncPopulationsToDataBase()
    {
        $populations = Http::get($_ENV['API_COUNTRIES'])->json()['data'];
        foreach ($populations as $population) {
            if (isset($population['populationCounts'])) {
                foreach ($population['populationCounts'] as $populationCount) {
                    $updatedPopulation = $this->populationRepository->createOrUpdate(
                        $population['code'],
                        $populationCount['year'],
                        $populationCount['value'],
                        $this->countryRepository->getCountry($population['code'])->id
                    );
                }
            }
        }
        return response([
            'done' => 'Populations have been created/updated'
        ], 200);
    }

    public function getPopulationOfCountry($countryId)
    {
        $population = $this->populationRepository->getPopulation($countryId);
        return $population->map->format();
    }

    public function getCountryWithMaxPopulation()
    {
        $country = $this->populationRepository->getCountryWithMaxPopulationLastYear();
        $population = $this->populationRepository->getMaxPopulationLastYear();
        return response([
            'Country' => $country,
            'Population' => $population,
        ], 200);
    }

    public function getCountryWithMinPopulation()
    {
        $country = $this->populationRepository->getCountryWithMinPopulationLastYear();
        $population = $this->populationRepository->getMinPopulationLastYear();
        return response([
            'Country' => $country,
            'Population' => $population,
        ], 200);
    }

    public function getCountriesWithMinAndMaxPopulations()
    {
        $country_min = $this->populationRepository->getCountryWithMinPopulationLastYear();
        $population_min = $this->populationRepository->getMinPopulationLastYear();
        $country_max = $this->populationRepository->getCountryWithMaxPopulationLastYear();
        $population_max = $this->populationRepository->getMaxPopulationLastYear();
        return response([
            'max' =>
            [
                'Country' => $country_max,
                'Population' => $population_max,
            ],
            'min' =>
            [
                'Country' => $country_min,
                'Population' => $population_min,
            ],
        ], 200);
    }
}

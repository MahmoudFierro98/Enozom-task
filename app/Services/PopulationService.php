<?php

namespace App\Services;

use App\Models\Population;
use App\Repository\CountryRepository;
use Illuminate\Support\Facades\Http;

class PopulationService
{
    // private PopulationRepository $Population;
    private CountryRepository $country;

    public function __construct()
    {
        // $this->Population = new PopulationRepository();
        $this->country = new CountryRepository();
    }

    public function syncCountriesToDataBase()
    {
        $countries = $this->country->getAllCountries();
        $allPopulations = Http::get($_ENV['API_COUNTRIES'])->json()['data'];
        foreach ($countries as $country) {
            foreach ($allPopulations as $population) {
                if ($population['code'] == $country['country_code'] && isset($population['populationCounts'])) {
                    foreach ($population['populationCounts'] as $populationCount) {
                        Population::updateOrCreate(
                            [
                                'code' => $country['country_code'],
                                'year' => $populationCount['year']
                            ],
                            [
                                'code' => $country['country_code'],
                                'year' => $populationCount['year'],
                                'value' => $populationCount['value'],
                                'country_id' => $country['id'],
                            ]
                        );
                    }
                }
            }
        }
        return response([
            'done' => 'Populations has been created/updated',
        ], 200);
    }
}

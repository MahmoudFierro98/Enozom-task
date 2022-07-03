<?php

namespace App\Repository;

use App\Models\Population;
use App\Repository\IPopulationRepository;
use App\Services\PopulationService;

class PopulationRepository implements IPopulationRepository
{
    public function createOrUpdate($code = null, $year, $value, $countryId)
    {
        return (Population::updateOrCreate(
            ['code' => $code, 'year' => $year],
            ['code' => $code, 'year' => $year, 'value' => $value, 'country_id' => $countryId],
        ));
    }

    public function getPopulation($id = null)
    {
        return Population::where('country_id', $id)->get();
    }

    public function getCountryWithMaxPopulationLastYear()
    {
        return Population::orderBy('year', 'desc')->orderBy('value', 'desc')->skip(1)->take(1)->first()->country;
    }

    public function getMaxPopulationLastYear()
    {
        return Population::orderBy('year', 'desc')->orderBy('value', 'desc')->skip(1)->take(1)->first()->value;
    }
    
    public function getCountryWithMinPopulationLastYear()
    {
        return Population::orderBy('year', 'desc')->orderBy('value', 'asc')->first()->country;
    }
    
    public function getMinPopulationLastYear()
    {
        return Population::orderBy('year', 'desc')->orderBy('value', 'asc')->first()->value;
    }
}

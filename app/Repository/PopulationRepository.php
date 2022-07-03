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
}

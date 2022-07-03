<?php

namespace App\Repository;

interface IPopulationRepository
{
    public function createOrUpdate($code = null, $year, $value, $countryId);

    public function getPopulation($id = null);
}

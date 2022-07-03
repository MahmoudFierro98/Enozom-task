<?php

namespace App\Repository;

interface IPopulationRepository
{
    public function createOrUpdate($code = null, $year, $value, $countryId);

    public function getPopulation($id = null);

    public function getCountryWithMaxPopulationLastYear();

    public function getCountryWithMinPopulationLastYear();

    public function getMaxPopulationLastYear();

    public function getMinPopulationLastYear();
}

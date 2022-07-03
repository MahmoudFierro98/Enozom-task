<?php

namespace App\Repository;

interface ICountryRepository
{
    public function getAllCountries();
    
    public function getCountriesPaging($pageSize, $page);

    public function createOrUpdate($code = null, $name);

    public function getCountry($id = null);
}

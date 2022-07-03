<?php

namespace App\Repository;

interface ICountryRepository
{
    public function getAllCountries();
    
    public function getCountriesPaging($perPage, $page);

    public function createOrUpdate($id = null, $name);

    public function getCountry($id = null);
}

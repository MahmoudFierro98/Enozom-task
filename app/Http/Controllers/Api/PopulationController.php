<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePopulationRequest;
use App\Http\Requests\UpdatePopulationRequest;
use App\Services\PopulationService;
use Illuminate\Http\Request;

class PopulationController extends Controller
{
    private PopulationService $PopulationService;

    public function __construct()
    {
        $this->PopulationService = new PopulationService();
    }

    public function syncPopulations(){
        return $this->PopulationService->syncCountriesToDataBase();
    }
}

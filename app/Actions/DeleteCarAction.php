<?php

namespace App\Actions;

use App\Models\Car;

class DeleteCarAction 
{
    public function execute(int $carId) 
    {
        $carTemp = Car::query()->findOrFail($carId);
        $carTemp->delete();
    }
}
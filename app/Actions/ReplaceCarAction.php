<?php

namespace App\Actions;

use App\Models\Dealership;
use App\Models\Car;
use Illuminate\Http\Exceptions\HttpResponseException;

class ReplaceCarAction 
{
    public function execute(int $carId, array $fields) : Car 
    {        
        Car::whereId($carId)->update($fields);

        $originalObject = Car::findOrFail($carId);

        return $originalObject;
    }
}
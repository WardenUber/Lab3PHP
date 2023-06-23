<?php

namespace App\Actions;

use App\Models\Dealership;
use App\Models\Car;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateCarAction 
{
    public function execute(array $fields) : Car
    {

        $dealership_id = $fields["dealerships_id"];

        $dealership = Dealership::find($dealership_id);

        if (!($dealership->empty))
        {
            $car = new Car($fields);

            $car->save();

            return $car;

        } else {
            throw new HttpResponseException(response()->json(["code" => 400, "message" => "Dealership doesn't exist"], 400));
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Actions\CreateCarAction;
use App\Http\Requests\CreateCarRequest;
use App\Http\Resources\CarResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Actions\DeleteCarAction;
use App\Actions\ReplaceCarAction;
use App\Http\Requests\ReplaceCarRequest;
use App\Models\Car;

class CarController extends Controller
{
    public function getAll()
    {
        return CarResource::collection(Car::all());
    }

    public function get(int $carId) 
    {
        try {
            return new CarResource(Car::query()->findOrFail($carId)); 
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404,"message" => "Car object not found"], 404);
        }
    }

    public function create(CreateCarRequest $request, CreateCarAction $action) 
    {
        $resource = new CarResource($action->execute($request->validated()));

        return $resource;
    }

    public function delete(int $carId, DeleteCarAction $action) 
    {
        try {
            $action->execute($carId);
            return response()->json(["code" => 200,"message" => "Car object was deleted"], 200);
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Car object wasn't found"], 404);
        }
    }

    public function replace(int $carId, ReplaceCarRequest $request, ReplaceCarAction $action) 
    {
        try {
            return new CarResource($action->execute($carId, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Car object wasn't found"], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Dealership;
use App\Models\Car;
use App\Http\Resources\CarResource;
use App\Actions\CreateDealershipAction;
use App\Actions\UpdateDealershipAction;
use App\Http\Resources\DealerShipsResource;
use App\Http\Requests\DealerShipsRequest;
use App\Http\Requests\UpdateDealershipRequest;

class DealerShipsController extends Controller
{
    public function getAll()
    {
        return DealerShipsResource::collection(Dealership::all());
    }

    public function get(int $dealershipId) 
    {
        try {
            return new DealerShipsResource(Dealership::query()->findOrFail($dealershipId)); 
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404,"message" => "Dealership object not found"], 404);
        }
    }

    public function getCars(int $dealershipId) 
    {
        try {
            return CarResource::collection(Car::where([['dealerships_id' ,'=', $dealershipId]])->get());
        } catch(ModelNotFoundException) {
            return response()->json(["code" => 404,"message" => "No cars in dealership"], 404);
        }
    }

    public function create(DealerShipsRequest $request, CreateDealershipAction $action) 
    {
        $resource = new DealerShipsResource($action->execute($request->validated()));

        return $resource;
    }

    public function update(int $dealershipId, UpdateDealershipRequest $request, UpdateDealershipAction $action)
    {
        try {
            return new DealerShipsResource($action->execute($dealershipId, $request->validated()));
        } catch (ModelNotFoundException) {
            return response()->json(["code" => 404, "message" => "Dealership object wasn't found"], 404);
        }
    }
}

<?php
namespace App\Actions;

use App\Models\Dealership;

class UpdateDealershipAction
{
    public function execute(int $dealerId, array $fields) : Dealership 
    {        
        Dealership::whereId($dealerId)->update($fields);

        $original_object = Dealership::findOrFail($dealerId);

        return $original_object;
    }
}
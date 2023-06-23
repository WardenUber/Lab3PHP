<?php

namespace App\Actions;

use App\Models\Dealership;

class CreateDealershipAction
{
    public function execute(array $fields) : Dealership
    {
        $new_dealer= new Dealership($fields);

        $new_dealer->save();

        return $new_dealer;
    }
}
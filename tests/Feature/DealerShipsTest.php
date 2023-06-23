<?php

use App\Models\Dealership;
use App\Models\Car;
use Illuminate\Testing\Fluent\AssertableJson;

use function Pest\Laravel\get;
use function PHPUnit\Framework\assertCount;
use function PHPUnit\Framework\assertEquals;
use function PHPUnit\Framework\assertNotNull;

it('has dealerships method', function () {

    $response = get('/api/v1/dealerships');

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });

    $response->assertStatus(200);
});

it('dealership/{id} get method with id', function() {

    $dealership1 = Dealership::factory()->createOne();

    $response = get('/api/v1/dealership/' . $dealership1->id);

    $json_obj_from_resp = $response->decodeResponseJson()['data'];

    assertEquals($dealership1->name, $json_obj_from_resp['name']);
    assertEquals($dealership1->address, $json_obj_from_resp['address']);
    assertEquals($dealership1->brand, $json_obj_from_resp['brand']);

    $dealership1->delete();
});

it('dealership put method works with data', function() {
    $obj_fields = [
        "name" => "privet3",
        "address" => "kak3",
        "brand" => "nikak3",
    ];

    $response = $this->putJson('/api/v1/dealership', $obj_fields);

    $response->assertStatus(201);

    $temp_dealership = Dealership::query(
        )->where(
            'name', '=', $obj_fields['name']
        )->where(
            'address', '=', $obj_fields['address']
        )->where(
            'brand', '=', $obj_fields['brand']
        )->first();

    $dealership1 = $response->decodeResponseJson()['data'];

    $dealership1 = Car::query()->find($dealership1['id']);

    assertNotNull($temp_dealership);

    $temp_dealership->delete();
});

it('dealership/{id} patch method works with correct data', function() {
    $dealership1 = Dealership::factory()->createOne();
    $dealership1->save();

    $obj_fields = [
        "name" => "privet2",
        "address" => "kak2",
        "brand" => "nikak2",
    ];

    $response = $this->patchJson('/api/v1/dealership/' . $dealership1->id, $obj_fields);

    $response->assertStatus(200);

    $dealership1 = Dealership::query()->find($dealership1->id);

    assertEquals($obj_fields['name'], $dealership1->name);
    assertEquals($obj_fields['address'], $dealership1->address);
    assertEquals($obj_fields['brand'], $dealership1->brand);

    $dealership1->delete();
});

it('dealership/{id} get method cars', function() {


    $car1 = Car::factory()->createOne();
    
    $response = get('/api/v1/dealership/cars/' . $car1->dealerships_id);

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });

    $json_data = $response->decodeResponseJson()['data'];

    $response->assertStatus(200);
    assertCount(1, $json_data);

    $json_obj_from_resp = $json_data[0];

    assertEquals($json_obj_from_resp['id'], $car1->id);
    assertEquals($json_obj_from_resp['name'], $car1->name);
    assertEquals($json_obj_from_resp['model'], $car1->model);
    assertEquals($json_obj_from_resp['brand'], $car1->brand);
    assertEquals($json_obj_from_resp['power'], $car1->power);
    assertEquals($json_obj_from_resp['volume'], $car1->volume);
    assertEquals($json_obj_from_resp['dealerships_id'], $car1->dealerships_id);

    $car1->delete();
});

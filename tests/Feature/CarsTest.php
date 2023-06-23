<?php

use App\Models\Dealership;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\Car;

use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function PHPUnit\Framework\assertEquals;

it('has cars method', function () {
    $response = get('/api/v1/cars');

    $response->assertJson(function (AssertableJson $json) {
        $json->has('data');
    });

    $response->assertStatus(200);
});

it('car/{id} get method works with id', function() {
    $cars_arr = Car::all();

    $temp_object = Car::all()[array_rand($cars_arr->toArray())];

    $response = get('/api/v1/car/' . $temp_object->id);

    $json_obj_from_resp = $response->decodeResponseJson()['data'];

    assertEquals($temp_object->name, $json_obj_from_resp['name']);
    assertEquals($temp_object->model, $json_obj_from_resp['model']);
    assertEquals($temp_object->brand, $json_obj_from_resp['brand']);
    assertEquals($temp_object->power, $json_obj_from_resp['power']);
    assertEquals($temp_object->volume, $json_obj_from_resp['volume']);
    assertEquals($temp_object->dealerships_id, $json_obj_from_resp['dealerships_id']);
});

it('car post method works with data', function() {
    $dealership = Dealership::factory()->createOne();

    $obj_fields = [
        'name' => 'car1Test',
        'model' => 'car1modelTest',
        'brand' => 'car1BrandTest',
        'power' => 150,
        'volume' => 3,
        'dealerships_id' => $dealership->id,
    ];

    $response = $this->postJson('/api/v1/car', $obj_fields);

    $car1 = $response->decodeResponseJson()['data'];

    $car2 = Car::query()->find($car1['id']);

    $response->assertStatus(201);
    
    $car2->delete();
    $dealership->delete();

});

it('car/{id} delete method with id', function() {

    $car1 = Car::factory()->createOne();

    $response = delete('/api/v1/car/' . $car1->id);

    $response->assertStatus(200);

    $query_res = Car::query()->find($car1->id);

    assertEquals(null, $query_res);

    $car1->delete();
});

it('car replace method works', function() {
    $car1 = Car::factory()->createOne();

    $obj_fields = [
        'name' => 'car1Test',
        'model' => 'car1modelTest',
        'brand' => 'car1BrandTest',
        'power' => 150,
        'volume' => 3,
        'dealerships_id' => $car1->dealerships_id,
    ];

    $response = $this->putJson('/api/v1/car/' . $car1->id, $obj_fields);

    $temp_car = Car::query()->find($car1->id);

    $response->assertStatus(200);

    assertEquals($obj_fields['name'], $temp_car['name']);
    assertEquals($obj_fields['model'], $temp_car['model']);
    assertEquals($obj_fields['brand'], $temp_car['brand']);
    assertEquals($obj_fields['power'], $temp_car['power']);
    assertEquals($obj_fields['volume'], $temp_car['volume']);
    assertEquals($obj_fields['dealerships_id'], $temp_car['dealerships_id']);

    $car1->delete();
});

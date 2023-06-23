<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UpdateDealershipRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['string'],
            'address' => ['string'],
            'brand' => ['string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        throw new HttpResponseException(response()->json(["code" => 400, "message" => $errors], 400));
    }
}

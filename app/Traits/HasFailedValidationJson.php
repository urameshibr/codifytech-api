<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

trait HasFailedValidationJson
{
    /**
     * Get the proper failed validation response for the request.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     *
     * @return void
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Ops, alguns problemas de validação foram encontrados.',
            'errors'  => $validator->errors()],
            422
        );

        throw new HttpResponseException($response);
    }
}

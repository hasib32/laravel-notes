<?php

namespace App\Http\Requests;

use App\Http\Controllers\ResponseTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    use ResponseTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Return errors (overriding default)
     *`
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        //convert array to string for consisting error response
        foreach ($errors as $key => $value) {
            $errors[$key] = $value[0];
        }

        return $this->sendInvalidFieldResponse($errors);
    }
}

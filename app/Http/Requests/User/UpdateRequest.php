<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = request()->segment(2);

        return [
            'email'                 => 'email|unique:users,email,'. $userId,
            'firstName'             => 'max:100',
            'middleName'            => 'max:50',
            'lastName'              => 'max:100',
            'username'              => 'max:50',
            'address'               => 'max:255',
            'zipCode'               => 'max:10',
            'phone'                 => 'max:20',
            'mobile'                => 'max:20',
            'city'                  => 'max:100',
            'state'                 => 'max:100',
            'country'               => 'max:100',
            'password'              => 'min:5'
        ];
    }
}

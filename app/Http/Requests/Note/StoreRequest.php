<?php

namespace App\Http\Requests\Note;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message'   => 'required',
            'tags'      => '',
            'userId'    => 'exists:users,id'
        ];
    }
}

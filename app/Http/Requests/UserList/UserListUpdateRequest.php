<?php

namespace Hedonist\Http\Requests\UserList;

use Illuminate\Foundation\Http\FormRequest;

class UserListUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'            => 'nullable|string|max:255',
            'image'           => 'nullable|image|max:5000',
            'attached_places' => 'nullable|array',
        ];
    }
}

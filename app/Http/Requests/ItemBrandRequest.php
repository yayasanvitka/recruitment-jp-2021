<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\ItemGroup;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ItemBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'group_id' => [
                'required',
                Rule::in(ItemGroup::pluck('id')->toArray())
            ],
            'code' => [
                'required',
                'string',
                'min:5',
                'max:7',
                Rule::unique('item_brands', 'code')->ignore(request()->id),
            ],
            'name' => 'required|min:5|max:255',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}

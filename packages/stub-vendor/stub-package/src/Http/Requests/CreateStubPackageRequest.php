<?php

namespace StubVendor\StubPackage\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use StubVendor\StubPackage\Models\StubPackage;

class CreateStubPackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('create', StubPackage::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // fields
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [];
    }
}

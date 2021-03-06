<?php

namespace Webmagic\EcommerceLight\DashboardIntegration\Http\Requests;


use Illuminate\Foundation\Http\FormRequest as Request;

class OptionRequest extends Request
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'value' => 'required|string'
        ];
    }
}
<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'menu_name' => 'required|string|max:255',
            'menu_type' => 'required|string|max:255',
            'menu_slug' => 'required|string|max:255|unique:menus,menu_slug',
            'menu_description' => 'nullable|string',
            'menu_price_cents' => 'required|integer|min:0',
            'menu_status' => 'required|boolean',
            'menu_image' => 'nullable|string|max:255',
        ];
    }
}

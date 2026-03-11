<?php
    
namespace Modules\Menu\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'menu_name' => 'sometimes|required|string|max:255',
            'menu_slug' => 'sometimes|required|string|max:255|unique:menus,menu_slug,' . $this->route('id'),
            'menu_description' => 'nullable|string',
            'menu_price_cents' => 'sometimes|required|integer|min:0',
            'menu_image' => 'nullable|string|max:255',
        ];
    }
}

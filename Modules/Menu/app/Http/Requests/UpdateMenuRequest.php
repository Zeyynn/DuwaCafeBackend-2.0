<?php
    
namespace Modules\Menu\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Menu\Providers\Enums\MenuStatus;

class UpdateMenuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'menu_id' => 'required|integer|exists:menu,menu_id',
            'menu_name' => 'sometimes|required|string|max:255',
            'menu_type' => 'sometimes|required|string|max:255',
            'menu_slug' => 'sometimes|required|string|max:255|unique:menus,menu_slug,' . $this->route('id'),
            'menu_description' => 'nullable|string',
            'menu_price_cents' => 'sometimes|required|integer|min:0',
            'menu_status' => 'sometimes|required|string|in:' . implode(',', array_column(MenuStatus::cases(), 'value')),
            'image' => 'nullable|file|image|max:5120',
        ];
    }
}

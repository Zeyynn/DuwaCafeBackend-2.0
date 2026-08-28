<?php

namespace Modules\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromCartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'menu_id' => ['required', 'integer'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeFireCardRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'                 => ['required', 'string', 'max:240', 'min:4'],
            'quantite_diamons'    => ['required', 'integer', 'max:100000', 'min:1'],
            'prix'                => ['required', 'integer', 'max:10000',],
            'descriptions_id'     => ['exists:descriptions,id', 'required'],
            'chemin_image'        => ['required', 'image', 'mimes:jpeg,svg,png,jpg', 'max:4048'],
        ];
    }
}

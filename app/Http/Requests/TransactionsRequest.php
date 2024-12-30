<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionsRequest extends FormRequest
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
            'nom'     => ['required', 'string', 'min:3'],
            'prenom'  => ['required', 'string', 'min:3'],
            'telephone'  => ['required', 'string', 'min:8', 'max:12'],
            'montant' => ['required', 'integer'],
            'capture_du_paiement' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'methode_de_paiement' => ['required', 'string'],
            'player_id' => ['required', 'min:10', 'max:10'],
            'user_id'   => ['required', 'exists:users,id'],
            'free_fire_card_id' => ['required', 'exists:free_fire_cards,id'],
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'regex:/^[A-Z][a-z][A-Za-z]* +[A-Z][a-z][A-Za-z]*$/'
            ],

            'street1' => [
                'required',
                'regex:/^[0-9]+ .+$/'
            ],

            'city' => ['required', 'string'],
            'state' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'country' => ['required', 'string'],

            'phone' => [
                'required',
                'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'
            ],

            'email' => [
                'required',
                'email'
            ],

            'card_number' => [
                'required',
                'regex:/^[0-9]{16}$/'
            ],

            'card_type' => [
                'required',
                'in:visa,mastercard,discover'
            ],

            'items' => ['required', 'array'],

            'items.*.item_id' => [
                'required',
                'exists:items,id'
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:0',
                'max:100'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Name must be formatted as Firstname Lastname.',
            'phone.regex' => 'Phone must be formatted as 123-456-7890.',
            'card_number.regex' => 'Credit card must contain 16 digits.',
        ];
    }
}

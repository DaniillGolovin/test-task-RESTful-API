<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'user_id' => 'sometimes|integer|exists:users,id',
            'amount' => 'sometimes|numeric|min:0',
            'type' => 'sometimes|string|in:debit,credit',
            'status' => 'sometimes|string|in:pending,completed,failed',
            'description' => 'sometimes|nullable|string|max:255',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class TransferRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'bail|required|numeric|exists:users,id',
            'amount' => 'required|numeric|min:1',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

}

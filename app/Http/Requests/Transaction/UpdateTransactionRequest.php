<?php

namespace App\Http\Requests\Transaction;

use App\Models\Operational\Transaction;
use Symfony\Component\HttpFoundation\Response;
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
            'appointment_id' => [
                'required', 'integer',
            ],
            'fee_doctor' => [
                'required', 'string', 'max:255',
            ],
            'fee_specialist' => [
                'required', 'string', 'max:255',
            ],
            'fee_hospital' => [
                'required', 'string', 'max:255',
            ],
            'sub_total' => [
                'required', 'string', 'max:255',
            ],
            'vat' => [
                'required', 'string', 'max:255',
            ],
            'total' => [
                'required', 'string', 'max:255',
            ],
            'bukti' => [
                'nullable', 'mimes:jpeg,svg,png', 'max:10000',
            ],
        ];
    }
}

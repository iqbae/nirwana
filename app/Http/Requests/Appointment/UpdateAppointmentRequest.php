<?php

namespace App\Http\Requests\Appointment;

use App\Models\Operational\Appointment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateAppointmentRequest extends FormRequest
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
            'doctor_id' => [
                'nullable', 'integer',
            ],
            'user_id' => [
                'nullable', 'integer',
            ],
            'consultation_id' => [
                'nullable', 'integer',
            ],
            'level' => [
                'nullable', 'string',
            ],
            'date' => [
                'nullable', 'date',
            ],
            'time' => [
                'nullable', 'time',
            ],
            'status' => [
                'nullable', 'string',
            ],
        ];
    }
}

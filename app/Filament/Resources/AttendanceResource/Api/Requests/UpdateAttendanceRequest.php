<?php

namespace App\Filament\Resources\AttendanceResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
			'student_id' => 'required|integer',
			'date' => 'required|date',
			'status' => 'required',
			'permission_reason' => 'required|string'
		];
    }
}

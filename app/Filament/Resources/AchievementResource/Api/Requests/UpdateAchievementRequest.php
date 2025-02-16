<?php

namespace App\Filament\Resources\AchievementResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAchievementRequest extends FormRequest
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
			'achievement_name' => 'required|string',
			'description' => 'required|string',
			'photo' => 'required|string'
		];
    }
}

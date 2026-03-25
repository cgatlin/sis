<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCourseRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'course_code' => ['required', 'string', 'max:12'],
            'course_name' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'string', 'max:12'],
            'year' => ['required', 'int'],
            'credits' => ['required', 'int'],
            'user' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    $query->where('role', 'teacher');
                }),
            ],
            'description' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'user.exists' => 'The selected user is not a valid teacher.',
        ];
    }
}

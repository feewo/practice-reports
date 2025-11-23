<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherReportsRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->isTeacher();
    }

    public function rules()
    {
        return [
            'course' => 'nullable|integer|min:1|max:6',
            'group_id' => 'nullable|exists:groups,id'
        ];
    }

    public function messages()
    {
        return [
            'course.integer' => 'Курс должен быть числом',
            'course.min' => 'Курс должен быть не менее 1',
            'course.max' => 'Курс должен быть не более 6',
            'group_id.exists' => 'Указанная группа не существует'
        ];
    }
}
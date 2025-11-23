<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SetGradeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->isTeacher();
    }

    public function rules()
    {
        return [
            'report_id' => 'required|exists:reports,id',
            'grade_type_id' => 'required|exists:grade_types,id',
            'comment' => 'nullable|string|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'report_id.required' => 'ID отчета обязателен',
            'report_id.exists' => 'Указанный отчет не существует',
            'grade_type_id.required' => 'ID оценки обязателен',
            'comment.string' => 'Комментарий должен быть строкой',
            'comment.max' => 'Комментарий не должен превышать 1000 символов'
        ];
    }
}
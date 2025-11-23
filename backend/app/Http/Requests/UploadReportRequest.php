<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UploadReportRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && Auth::user()->isStudent();
    }

    public function rules()
    {
        return [
            'internship_id' => 'required|exists:internships,id',
            'file' => 'required|file|mimes:pdf,docx|max:20480'
        ];
    }

    public function messages()
    {
        return [
            'internship_id.required' => 'ID практики обязателен',
            'internship_id.exists' => 'Указанная практика не существует',
            'file.required' => 'Файл обязателен',
            'file.file' => 'Загруженный файл невалиден',
            'file.mimes' => 'Файл должен быть в формате PDF или DOCX',
            'file.max' => 'Размер файла не должен превышать 20MB'
        ];
    }
}
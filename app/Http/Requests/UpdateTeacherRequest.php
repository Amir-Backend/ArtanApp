<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $teacherId = $this->route('teacher')?->id;

        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'national_code' => [
                'required',
                'string',
                'max:20',
                'unique:teachers,national_code,' . $teacherId,
            ],
            'percentage' => 'nullable|numeric|min:0|max:100',
            'features' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'وارد کردن نام الزامی است.',
            'last_name.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
            'percentage.numeric' => 'درصد باید عدد باشد.',
            'percentage.min' => 'درصد نمی‌تواند کمتر از صفر باشد.',
            'percentage.max' => 'درصد نمی‌تواند بیشتر از ۱۰۰ باشد.',
        ];
    }
}

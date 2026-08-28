<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'national_code' => 'required|string|max:20|unique:students,national_code',
            'gender' => 'required|in:male,female',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'وارد کردن نام الزامی است.',
            'last_name.required' => 'وارد کردن نام خانوادگی الزامی است.',
            'national_code.required' => 'وارد کردن کد ملی الزامی است.',
            'national_code.unique' => 'این کد ملی قبلاً ثبت شده است.',
            'gender.required' => 'انتخاب جنسیت الزامی است.',
            'gender.in' => 'جنسیت انتخاب‌شده معتبر نیست.',
            'birth_date.date' => 'تاریخ تولد معتبر نیست.',
        ];
    }
}

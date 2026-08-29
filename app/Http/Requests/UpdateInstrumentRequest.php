<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInstrumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $instrumentId = $this->route('instrument')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:instruments,name,' . $instrumentId,
            ],
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام ساز الزامی است.',
            'name.unique' => 'این ساز قبلاً ثبت شده است.',
            'status.required' => 'وضعیت الزامی است.',
            'status.in' => 'وضعیت انتخاب‌شده معتبر نیست.',
        ];
    }
}

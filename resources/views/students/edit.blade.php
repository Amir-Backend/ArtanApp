@extends('layouts.master')

@section('title', 'ویرایش هنرجو')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>ویرایش هنرجو</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-right: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.update', $student) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name" class="form-label">نام</label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name', $student->first_name) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="last_name" class="form-label">نام خانوادگی</label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name', $student->last_name) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="national_code" class="form-label">کد ملی</label>
                <input
                    type="text"
                    id="national_code"
                    name="national_code"
                    value="{{ old('national_code', $student->national_code) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="gender" class="form-label">جنسیت</label>
                <select id="gender" name="gender" class="form-control">
                    <option value="">انتخاب کنید</option>

                    <option
                        value="male"
                        {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}
                    >
                        مرد
                    </option>

                    <option
                        value="female"
                        {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}
                    >
                        زن
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label for="birth_date" class="form-label">تاریخ تولد</label>
                <input
                    type="date"
                    id="birth_date"
                    name="birth_date"
                    value="{{ old('birth_date', $student->birth_date?->format('Y-m-d')) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">شماره تماس</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $student->phone) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="address" class="form-label">آدرس</label>
                <textarea
                    id="address"
                    name="address"
                    rows="4"
                    class="form-control"
                >{{ old('address', $student->address) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                <a href="{{ route('students.index') }}" class="btn btn-secondary">انصراف</a>
            </div>

        </form>

    </div>

@endsection

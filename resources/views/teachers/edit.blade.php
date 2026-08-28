@extends('layouts.master')

@section('title', 'ویرایش استاد')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>ویرایش استاد</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-right: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teachers.update', $teacher) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="first_name" class="form-label">نام</label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name', $teacher->first_name) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="last_name" class="form-label">نام خانوادگی</label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name', $teacher->last_name) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="phone" class="form-label">شماره تماس</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $teacher->phone) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="national_code" class="form-label">کد ملی</label>
                <input
                    type="text"
                    id="national_code"
                    name="national_code"
                    value="{{ old('national_code', $teacher->national_code) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="percentage" class="form-label">درصد حق‌التدریس</label>
                <input
                    type="number"
                    step="0.01"
                    min="0"
                    max="100"
                    id="percentage"
                    name="percentage"
                    value="{{ old('percentage', $teacher->percentage) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="features" class="form-label">خصوصیات (ویژگی‌ها)</label>
                <textarea
                    id="features"
                    name="features"
                    rows="4"
                    class="form-control"
                >{{ old('features', $teacher->features) }}</textarea>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                <a href="{{ route('teachers.index') }}" class="btn btn-secondary">انصراف</a>
            </div>

        </form>

    </div>

@endsection

@extends('layouts.master')

@section('title', 'مشخصات هنرجو')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>مشخصات هنرجو</h2>

        <div class="table-wrapper">
            <table class="data-table">
                <tr>
                    <th style="width: 160px;">شناسه</th>
                    <td>{{ $student->id }}</td>
                </tr>
                <tr>
                    <th>نام</th>
                    <td>{{ $student->first_name }}</td>
                </tr>
                <tr>
                    <th>نام خانوادگی</th>
                    <td>{{ $student->last_name }}</td>
                </tr>
                <tr>
                    <th>کد ملی</th>
                    <td>{{ $student->national_code }}</td>
                </tr>
                <tr>
                    <th>جنسیت</th>
                    <td>{{ $student->gender === 'male' ? 'مرد' : 'زن' }}</td>
                </tr>
                <tr>
                    <th>تاریخ تولد</th>
                    <td>{{ $student->birth_date?->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <th>شماره تماس</th>
                    <td>{{ $student->phone }}</td>
                </tr>
                <tr>
                    <th>آدرس</th>
                    <td>{{ $student->address }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ $student->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="form-actions">
            <a href="{{ route('students.edit', $student) }}" class="btn btn-primary">ویرایش</a>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">بازگشت به لیست</a>
        </div>

    </div>

@endsection

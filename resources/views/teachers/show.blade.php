@extends('layouts.master')

@section('title', 'مشخصات استاد')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>مشخصات استاد</h2>

        <div class="table-wrapper">
            <table class="data-table">
                <tr>
                    <th style="width: 160px;">شناسه</th>
                    <td>{{ $teacher->id }}</td>
                </tr>
                <tr>
                    <th>نام</th>
                    <td>{{ $teacher->first_name }}</td>
                </tr>
                <tr>
                    <th>نام خانوادگی</th>
                    <td>{{ $teacher->last_name }}</td>
                </tr>
                <tr>
                    <th>شماره تماس</th>
                    <td>{{ $teacher->phone }}</td>
                </tr>
                <tr>
                    <th>کد ملی</th>
                    <td>{{ $teacher->national_code }}</td>
                </tr>
                <tr>
                    <th>درصد حق‌التدریس</th>
                    <td>{{ $teacher->percentage }}%</td>
                </tr>
                <tr>
                    <th>خصوصیات</th>
                    <td>{{ $teacher->features }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ $teacher->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="form-actions">
            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-primary">ویرایش</a>
            <a href="{{ route('teachers.index') }}" class="btn btn-secondary">بازگشت به لیست</a>
        </div>

    </div>

@endsection

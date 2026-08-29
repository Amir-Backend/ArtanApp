@extends('layouts.master')

@section('title', 'مشخصات اتصال استاد و ساز')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>مشخصات اتصال استاد و ساز</h2>

        <div class="table-wrapper">
            <table class="data-table">
                <tr>
                    <th style="width: 160px;">شناسه</th>
                    <td>{{ $teacherSkill->id }}</td>
                </tr>
                <tr>
                    <th>استاد</th>
                    <td>
                        <a href="{{ route('teachers.show', $teacherSkill->teacher_id) }}">
                            {{ $teacherSkill->teacher->first_name }} {{ $teacherSkill->teacher->last_name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>ساز</th>
                    <td>
                        <a href="{{ route('instruments.show', $teacherSkill->instrument_id) }}">
                            {{ $teacherSkill->instrument->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>سطح تدریس</th>
                    <td>{{ $teacherSkill->level ?? '—' }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ $teacherSkill->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="form-actions">
            <a href="{{ route('teacher-skills.edit', $teacherSkill) }}" class="btn btn-primary">ویرایش</a>
            <a href="{{ route('teacher-skills.index') }}" class="btn btn-secondary">بازگشت به لیست</a>
        </div>

    </div>

@endsection

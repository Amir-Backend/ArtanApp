@extends('layouts.master')

@section('title', 'مشخصات ساز')

@section('content')

    <div class="card" style="max-width: 720px;">

        <h2>مشخصات ساز</h2>

        <div class="table-wrapper">
            <table class="data-table">
                <tr>
                    <th style="width: 160px;">شناسه</th>
                    <td>{{ $instrument->id }}</td>
                </tr>
                <tr>
                    <th>نام ساز</th>
                    <td>{{ $instrument->name }}</td>
                </tr>
                <tr>
                    <th>توضیحات</th>
                    <td>{{ $instrument->description }}</td>
                </tr>
                <tr>
                    <th>وضعیت</th>
                    <td>{{ $instrument->status === 'active' ? 'فعال' : 'غیرفعال' }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ $instrument->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            </table>
        </div>

        <div class="form-actions">
            <a href="{{ route('instruments.edit', $instrument) }}" class="btn btn-primary">ویرایش</a>
            <a href="{{ route('instruments.index') }}" class="btn btn-secondary">بازگشت به لیست</a>
        </div>

    </div>

    <div class="card" style="max-width: 720px; margin-top: 20px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">اساتید مسلط بر این ساز</h2>

            <a href="{{ route('teacher-skills.create') }}" class="btn btn-primary btn-sm">
                + اتصال استاد جدید
            </a>
        </div>

        @if ($instrument->teacherSkills->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>استاد</th>
                            <th>سطح</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($instrument->teacherSkills as $skill)
                            <tr>
                                <td>{{ $skill->teacher->first_name }} {{ $skill->teacher->last_name }}</td>
                                <td>{{ $skill->level ?? '—' }}</td>
                                <td>
                                    <a href="{{ route('teacher-skills.show', $skill) }}" class="btn btn-secondary btn-sm">
                                        نمایش
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="empty-state">
                هنوز هیچ استادی برای این ساز ثبت نشده است.
            </div>

        @endif

    </div>

@endsection

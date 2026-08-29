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

    <div class="card" style="max-width: 640px; margin-top: 20px;">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">سازهای قابل تدریس</h2>

            <a href="{{ route('teacher-skills.create', ['teacher_id' => $teacher->id]) }}" class="btn btn-primary btn-sm">
                + افزودن ساز
            </a>
        </div>

        @if ($teacher->teacherSkills->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ساز</th>
                            <th>سطح</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($teacher->teacherSkills as $skill)
                            <tr>
                                <td>{{ $skill->instrument->name }}</td>
                                <td>{{ $skill->level ?? '—' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('teacher-skills.edit', $skill) }}" class="btn btn-secondary btn-sm">
                                            ویرایش
                                        </a>

                                        <form
                                            action="{{ route('teacher-skills.destroy', $skill) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این ساز از لیست استاد مطمئن هستید؟');"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @else

            <div class="empty-state">
                هنوز سازی برای این استاد ثبت نشده است.
            </div>

        @endif

    </div>

@endsection

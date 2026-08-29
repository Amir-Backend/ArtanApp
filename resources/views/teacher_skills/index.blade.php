@extends('layouts.master')

@section('title', 'لیست مهارت‌های اساتید')

@section('content')

    <div class="card">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">اتصال اساتید به سازها</h2>

            <a href="{{ route('teacher-skills.create') }}" class="btn btn-primary">
                + اتصال جدید
            </a>
        </div>

        @if ($teacherSkills->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>استاد</th>
                            <th>ساز</th>
                            <th>سطح</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($teacherSkills as $skill)
                            <tr>
                                <td>{{ $skill->id }}</td>
                                <td>{{ $skill->teacher->first_name }} {{ $skill->teacher->last_name }}</td>
                                <td>{{ $skill->instrument->name }}</td>
                                <td>{{ $skill->level ?? '—' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('teacher-skills.show', $skill) }}" class="btn btn-secondary btn-sm">
                                            نمایش
                                        </a>

                                        <a href="{{ route('teacher-skills.edit', $skill) }}" class="btn btn-secondary btn-sm">
                                            ویرایش
                                        </a>

                                        <form
                                            action="{{ route('teacher-skills.destroy', $skill) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این اتصال مطمئن هستید؟');"
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

            <div class="pagination-wrapper">
                {{ $teacherSkills->links() }}
            </div>

        @else

            <div class="empty-state">
                هنوز هیچ استادی به سازی متصل نشده است.
            </div>

        @endif

    </div>

@endsection

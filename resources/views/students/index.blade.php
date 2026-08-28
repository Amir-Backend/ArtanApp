@extends('layouts.master')

@section('title', 'لیست هنرجویان')

@section('content')

    <div class="card">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">لیست هنرجویان</h2>

            <a href="{{ route('students.create') }}" class="btn btn-primary">
                + ثبت هنرجوی جدید
            </a>
        </div>

        @if ($students->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>کد ملی</th>
                            <th>جنسیت</th>
                            <th>تاریخ تولد</th>
                            <th>شماره تماس</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->first_name }}</td>
                                <td>{{ $student->last_name }}</td>
                                <td>{{ $student->national_code }}</td>
                                <td>{{ $student->gender === 'male' ? 'مرد' : 'زن' }}</td>
                                <td>{{ $student->birth_date?->format('Y-m-d') }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('students.show', $student) }}" class="btn btn-info btn-sm">
                                            نمایش
                                        </a>

                                        <a href="{{ route('students.edit', $student) }}" class="btn btn-success btn-sm">
                                            ویرایش
                                        </a>

                                        <form
                                            action="{{ route('students.destroy', $student) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این هنرجو مطمئن هستید؟');"
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
                {{ $students->links() }}
            </div>

        @else

            <div class="empty-state">
                هنوز هیچ هنرجویی ثبت نشده است.
            </div>

        @endif

    </div>

@endsection

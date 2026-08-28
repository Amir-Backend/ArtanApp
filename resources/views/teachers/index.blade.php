@extends('layouts.master')

@section('title', 'لیست اساتید')

@section('content')

    <div class="card">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">لیست اساتید</h2>

            <a href="{{ route('teachers.create') }}" class="btn btn-primary">
                + ثبت استاد جدید
            </a>
        </div>

        @if ($teachers->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام</th>
                            <th>نام خانوادگی</th>
                            <th>شماره تماس</th>
                            <th>کد ملی</th>
                            <th>درصد</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($teachers as $teacher)
                            <tr>
                                <td>{{ $teacher->id }}</td>
                                <td>{{ $teacher->first_name }}</td>
                                <td>{{ $teacher->last_name }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->national_code }}</td>
                                <td>{{ $teacher->percentage }}%</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-secondary btn-sm">
                                            نمایش
                                        </a>

                                        <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-secondary btn-sm">
                                            ویرایش
                                        </a>

                                        <form
                                            action="{{ route('teachers.destroy', $teacher) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این استاد مطمئن هستید؟');"
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
                {{ $teachers->links() }}
            </div>

        @else

            <div class="empty-state">
                هنوز هیچ استادی ثبت نشده است.
            </div>

        @endif

    </div>

@endsection

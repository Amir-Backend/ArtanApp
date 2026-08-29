@extends('layouts.master')

@section('title', 'لیست سازها')

@section('content')

    <div class="card">

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
            <h2 style="margin: 0;">لیست سازها</h2>

            <a href="{{ route('instruments.create') }}" class="btn btn-primary">
                + ثبت ساز جدید
            </a>
        </div>

        @if ($instruments->count())

            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>شناسه</th>
                            <th>نام ساز</th>
                            <th>توضیحات</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($instruments as $instrument)
                            <tr>
                                <td>{{ $instrument->id }}</td>
                                <td>{{ $instrument->name }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($instrument->description, 60) }}</td>
                                <td>{{ $instrument->status === 'active' ? 'فعال' : 'غیرفعال' }}</td>
                                <td>
                                    <div class="table-actions">
                                        <a href="{{ route('instruments.show', $instrument) }}" class="btn btn-secondary btn-sm">
                                            نمایش
                                        </a>

                                        <a href="{{ route('instruments.edit', $instrument) }}" class="btn btn-secondary btn-sm">
                                            ویرایش
                                        </a>

                                        <form
                                            action="{{ route('instruments.destroy', $instrument) }}"
                                            method="POST"
                                            onsubmit="return confirm('آیا از حذف این ساز مطمئن هستید؟');"
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
                {{ $instruments->links() }}
            </div>

        @else

            <div class="empty-state">
                هنوز هیچ سازی ثبت نشده است.
            </div>

        @endif

    </div>

@endsection

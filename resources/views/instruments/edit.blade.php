@extends('layouts.master')

@section('title', 'ویرایش ساز')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>ویرایش ساز</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-right: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('instruments.update', $instrument) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label">نام ساز</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $instrument->name) }}"
                    class="form-control"
                >
            </div>

            <div class="form-group">
                <label for="description" class="form-label">توضیحات</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="form-control"
                >{{ old('description', $instrument->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status" class="form-label">وضعیت</label>
                <select id="status" name="status" class="form-control">
                    <option value="active" {{ old('status', $instrument->status) === 'active' ? 'selected' : '' }}>فعال</option>
                    <option value="inactive" {{ old('status', $instrument->status) === 'inactive' ? 'selected' : '' }}>غیرفعال</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                <a href="{{ route('instruments.index') }}" class="btn btn-secondary">انصراف</a>
            </div>

        </form>

    </div>

@endsection

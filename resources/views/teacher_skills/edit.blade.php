@extends('layouts.master')

@section('title', 'ویرایش اتصال استاد و ساز')

@section('content')

    <div class="card" style="max-width: 640px;">

        <h2>ویرایش اتصال استاد و ساز</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-right: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('teacher-skills.update', $teacherSkill) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="teacher_id" class="form-label">استاد</label>
                <select id="teacher_id" name="teacher_id" class="form-control">
                    @foreach ($teachers as $teacher)
                        <option
                            value="{{ $teacher->id }}"
                            {{ (int) old('teacher_id', $teacherSkill->teacher_id) === $teacher->id ? 'selected' : '' }}
                        >
                            {{ $teacher->first_name }} {{ $teacher->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="instrument_id" class="form-label">ساز</label>
                <select id="instrument_id" name="instrument_id" class="form-control">
                    @foreach ($instruments as $instrument)
                        <option
                            value="{{ $instrument->id }}"
                            {{ (int) old('instrument_id', $teacherSkill->instrument_id) === $instrument->id ? 'selected' : '' }}
                        >
                            {{ $instrument->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="level" class="form-label">سطح تدریس</label>
                <input
                    type="text"
                    id="level"
                    name="level"
                    value="{{ old('level', $teacherSkill->level) }}"
                    class="form-control"
                    placeholder="مثال: مقدماتی، متوسط، پیشرفته"
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
                <a href="{{ route('teacher-skills.index') }}" class="btn btn-secondary">انصراف</a>
            </div>

        </form>

    </div>

@endsection

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Services\TeacherService;

class TeacherController extends Controller
{
    public function __construct(protected TeacherService $teacherService)
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Teacher::class);

        $teachers = $this->teacherService->paginate();

        return view('teachers.index', compact('teachers'));
    }

    public function create()
    {
        $this->authorize('create', Teacher::class);

        return view('teachers.create');
    }

    public function store(StoreTeacherRequest $request)
    {
        $this->authorize('create', Teacher::class);

        $this->teacherService->create($request->validated());

        return redirect()
            ->route('teachers.index')
            ->with('success', 'استاد با موفقیت ثبت شد.');
    }

    public function show(Teacher $teacher)
    {
        $this->authorize('view', $teacher);

        $teacher->load('teacherSkills.instrument');

        return view('teachers.show', compact('teacher'));
    }

    public function edit(Teacher $teacher)
    {
        $this->authorize('update', $teacher);

        return view('teachers.edit', compact('teacher'));
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        $this->authorize('update', $teacher);

        $this->teacherService->update($teacher, $request->validated());

        return redirect()
            ->route('teachers.index')
            ->with('success', 'اطلاعات استاد با موفقیت ویرایش شد.');
    }

    public function destroy(Teacher $teacher)
    {
        $this->authorize('delete', $teacher);

        $this->teacherService->delete($teacher);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'استاد با موفقیت حذف شد.');
    }
}

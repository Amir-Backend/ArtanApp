<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Services\StudentService;

class StudentController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Student::class);

        $students = $this->studentService->paginate();

        return view('students.index', compact('students'));
    }

    public function create()
    {
        $this->authorize('create', Student::class);

        return view('students.create');
    }

    public function store(StoreStudentRequest $request)
    {
        $this->authorize('create', Student::class);

        $this->studentService->create($request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'هنرجو با موفقیت ثبت شد.');
    }

    public function show(Student $student)
    {
        $this->authorize('view', $student);

        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        $this->authorize('update', $student);

        return view('students.edit', compact('student'));
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $this->authorize('update', $student);

        $this->studentService->update($student, $request->validated());

        return redirect()
            ->route('students.index')
            ->with('success', 'اطلاعات هنرجو با موفقیت ویرایش شد.');
    }

    public function destroy(Student $student)
    {
        $this->authorize('delete', $student);

        $this->studentService->delete($student);

        return redirect()
            ->route('students.index')
            ->with('success', 'هنرجو با موفقیت حذف شد.');
    }
}


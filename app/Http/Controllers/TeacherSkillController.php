<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherSkillRequest;
use App\Http\Requests\UpdateTeacherSkillRequest;
use App\Models\Teacher;
use App\Models\TeacherSkill;
use App\Services\InstrumentService;
use App\Services\TeacherService;
use App\Services\TeacherSkillService;

class TeacherSkillController extends Controller
{
    public function __construct(
        protected TeacherSkillService $teacherSkillService,
        protected TeacherService $teacherService,
        protected InstrumentService $instrumentService,
    ) {
    }

    public function index()
    {
        $this->authorize('viewAny', TeacherSkill::class);

        $teacherSkills = $this->teacherSkillService->paginate();

        return view('teacher_skills.index', compact('teacherSkills'));
    }

    public function create()
    {
        $this->authorize('create', TeacherSkill::class);

        $teachers = Teacher::query()->orderBy('first_name')->get();
        $instruments = $this->instrumentService->allActive();

        // امکان پیش‌انتخاب استاد از طریق کوئری‌استرینگ (مثلاً از صفحه‌ی نمایش استاد)
        $selectedTeacherId = request()->integer('teacher_id') ?: null;

        return view('teacher_skills.create', compact('teachers', 'instruments', 'selectedTeacherId'));
    }

    public function store(StoreTeacherSkillRequest $request)
    {
        $this->authorize('create', TeacherSkill::class);

        $this->teacherSkillService->create($request->validated());

        return redirect()
            ->route('teacher-skills.index')
            ->with('success', 'مهارت استاد با موفقیت ثبت شد.');
    }

    public function show(TeacherSkill $teacherSkill)
    {
        $this->authorize('view', $teacherSkill);

        $teacherSkill->load(['teacher', 'instrument']);

        return view('teacher_skills.show', compact('teacherSkill'));
    }

    public function edit(TeacherSkill $teacherSkill)
    {
        $this->authorize('update', $teacherSkill);

        $teachers = Teacher::query()->orderBy('first_name')->get();
        $instruments = $this->instrumentService->allActive();

        return view('teacher_skills.edit', compact('teacherSkill', 'teachers', 'instruments'));
    }

    public function update(UpdateTeacherSkillRequest $request, TeacherSkill $teacherSkill)
    {
        $this->authorize('update', $teacherSkill);

        $this->teacherSkillService->update($teacherSkill, $request->validated());

        return redirect()
            ->route('teacher-skills.index')
            ->with('success', 'مهارت استاد با موفقیت ویرایش شد.');
    }

    public function destroy(TeacherSkill $teacherSkill)
    {
        $this->authorize('delete', $teacherSkill);

        $this->teacherSkillService->delete($teacherSkill);

        return redirect()
            ->route('teacher-skills.index')
            ->with('success', 'مهارت استاد با موفقیت حذف شد.');
    }
}

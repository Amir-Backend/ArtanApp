<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherSkillRequest;
use App\Http\Requests\UpdateTeacherSkillRequest;
use App\Http\Resources\TeacherSkillResource;
use App\Models\TeacherSkill;
use App\Services\TeacherSkillService;
use Illuminate\Http\JsonResponse;

class TeacherSkillApiController extends Controller
{
    public function __construct(protected TeacherSkillService $teacherSkillService)
    {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', TeacherSkill::class);

        $teacherSkills = $this->teacherSkillService->paginate();

        return response()->json([
            'data' => TeacherSkillResource::collection($teacherSkills),
            'meta' => [
                'current_page' => $teacherSkills->currentPage(),
                'last_page' => $teacherSkills->lastPage(),
                'total' => $teacherSkills->total(),
            ],
        ]);
    }

    public function store(StoreTeacherSkillRequest $request): JsonResponse
    {
        $this->authorize('create', TeacherSkill::class);

        $teacherSkill = $this->teacherSkillService->create($request->validated());
        $teacherSkill->load(['teacher', 'instrument']);

        return response()->json([
            'message' => 'مهارت استاد با موفقیت ثبت شد.',
            'data' => new TeacherSkillResource($teacherSkill),
        ], 201);
    }

    public function show(TeacherSkill $teacherSkill): JsonResponse
    {
        $this->authorize('view', $teacherSkill);

        $teacherSkill->load(['teacher', 'instrument']);

        return response()->json([
            'data' => new TeacherSkillResource($teacherSkill),
        ]);
    }

    public function update(UpdateTeacherSkillRequest $request, TeacherSkill $teacherSkill): JsonResponse
    {
        $this->authorize('update', $teacherSkill);

        $teacherSkill = $this->teacherSkillService->update($teacherSkill, $request->validated());
        $teacherSkill->load(['teacher', 'instrument']);

        return response()->json([
            'message' => 'مهارت استاد با موفقیت ویرایش شد.',
            'data' => new TeacherSkillResource($teacherSkill),
        ]);
    }

    public function destroy(TeacherSkill $teacherSkill): JsonResponse
    {
        $this->authorize('delete', $teacherSkill);

        $this->teacherSkillService->delete($teacherSkill);

        return response()->json([
            'message' => 'مهارت استاد با موفقیت حذف شد.',
        ]);
    }
}

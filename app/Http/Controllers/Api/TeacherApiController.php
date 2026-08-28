<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Http\Resources\TeacherResource;
use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Http\JsonResponse;

class TeacherApiController extends Controller
{
    public function __construct(protected TeacherService $teacherService)
    {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Teacher::class);

        $teachers = $this->teacherService->paginate();

        return response()->json([
            'data' => TeacherResource::collection($teachers),
            'meta' => [
                'current_page' => $teachers->currentPage(),
                'last_page' => $teachers->lastPage(),
                'total' => $teachers->total(),
            ],
        ]);
    }

    public function store(StoreTeacherRequest $request): JsonResponse
    {
        $this->authorize('create', Teacher::class);

        $teacher = $this->teacherService->create($request->validated());

        return response()->json([
            'message' => 'استاد با موفقیت ثبت شد.',
            'data' => new TeacherResource($teacher),
        ], 201);
    }

    public function show(Teacher $teacher): JsonResponse
    {
        $this->authorize('view', $teacher);

        return response()->json([
            'data' => new TeacherResource($teacher),
        ]);
    }

    public function update(UpdateTeacherRequest $request, Teacher $teacher): JsonResponse
    {
        $this->authorize('update', $teacher);

        $teacher = $this->teacherService->update($teacher, $request->validated());

        return response()->json([
            'message' => 'اطلاعات استاد با موفقیت ویرایش شد.',
            'data' => new TeacherResource($teacher),
        ]);
    }

    public function destroy(Teacher $teacher): JsonResponse
    {
        $this->authorize('delete', $teacher);

        $this->teacherService->delete($teacher);

        return response()->json([
            'message' => 'استاد با موفقیت حذف شد.',
        ]);
    }
}

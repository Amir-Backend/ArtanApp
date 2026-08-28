<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;

class StudentApiController extends Controller
{
    public function __construct(protected StudentService $studentService)
    {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Student::class);

        $students = $this->studentService->paginate();

        return response()->json([
            'data' => StudentResource::collection($students),
            'meta' => [
                'current_page' => $students->currentPage(),
                'last_page' => $students->lastPage(),
                'total' => $students->total(),
            ],
        ]);
    }

    public function store(StoreStudentRequest $request): JsonResponse
    {
        $this->authorize('create', Student::class);

        $student = $this->studentService->create($request->validated());

        return response()->json([
            'message' => 'هنرجو با موفقیت ثبت شد.',
            'data' => new StudentResource($student),
        ], 201);
    }

    public function show(Student $student): JsonResponse
    {
        $this->authorize('view', $student);

        return response()->json([
            'data' => new StudentResource($student),
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $student): JsonResponse
    {
        $this->authorize('update', $student);

        $student = $this->studentService->update($student, $request->validated());

        return response()->json([
            'message' => 'اطلاعات هنرجو با موفقیت ویرایش شد.',
            'data' => new StudentResource($student),
        ]);
    }

    public function destroy(Student $student): JsonResponse
    {
        $this->authorize('delete', $student);

        $this->studentService->delete($student);

        return response()->json([
            'message' => 'هنرجو با موفقیت حذف شد.',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInstrumentRequest;
use App\Http\Requests\UpdateInstrumentRequest;
use App\Http\Resources\InstrumentResource;
use App\Models\Instrument;
use App\Services\InstrumentService;
use Illuminate\Http\JsonResponse;

class InstrumentApiController extends Controller
{
    public function __construct(protected InstrumentService $instrumentService)
    {
    }

    public function index(): JsonResponse
    {
        $this->authorize('viewAny', Instrument::class);

        $instruments = $this->instrumentService->paginate();

        return response()->json([
            'data' => InstrumentResource::collection($instruments),
            'meta' => [
                'current_page' => $instruments->currentPage(),
                'last_page' => $instruments->lastPage(),
                'total' => $instruments->total(),
            ],
        ]);
    }

    public function store(StoreInstrumentRequest $request): JsonResponse
    {
        $this->authorize('create', Instrument::class);

        $instrument = $this->instrumentService->create($request->validated());

        return response()->json([
            'message' => 'ساز با موفقیت ثبت شد.',
            'data' => new InstrumentResource($instrument),
        ], 201);
    }

    public function show(Instrument $instrument): JsonResponse
    {
        $this->authorize('view', $instrument);

        return response()->json([
            'data' => new InstrumentResource($instrument),
        ]);
    }

    public function update(UpdateInstrumentRequest $request, Instrument $instrument): JsonResponse
    {
        $this->authorize('update', $instrument);

        $instrument = $this->instrumentService->update($instrument, $request->validated());

        return response()->json([
            'message' => 'اطلاعات ساز با موفقیت ویرایش شد.',
            'data' => new InstrumentResource($instrument),
        ]);
    }

    public function destroy(Instrument $instrument): JsonResponse
    {
        $this->authorize('delete', $instrument);

        $this->instrumentService->delete($instrument);

        return response()->json([
            'message' => 'ساز با موفقیت حذف شد.',
        ]);
    }
}

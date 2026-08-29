<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstrumentRequest;
use App\Http\Requests\UpdateInstrumentRequest;
use App\Models\Instrument;
use App\Services\InstrumentService;

class InstrumentController extends Controller
{
    public function __construct(protected InstrumentService $instrumentService)
    {
    }

    public function index()
    {
        $this->authorize('viewAny', Instrument::class);

        $instruments = $this->instrumentService->paginate();

        return view('instruments.index', compact('instruments'));
    }

    public function create()
    {
        $this->authorize('create', Instrument::class);

        return view('instruments.create');
    }

    public function store(StoreInstrumentRequest $request)
    {
        $this->authorize('create', Instrument::class);

        $this->instrumentService->create($request->validated());

        return redirect()
            ->route('instruments.index')
            ->with('success', 'ساز با موفقیت ثبت شد.');
    }

    public function show(Instrument $instrument)
    {
        $this->authorize('view', $instrument);

        $instrument->load(['teacherSkills.teacher']);

        return view('instruments.show', compact('instrument'));
    }

    public function edit(Instrument $instrument)
    {
        $this->authorize('update', $instrument);

        return view('instruments.edit', compact('instrument'));
    }

    public function update(UpdateInstrumentRequest $request, Instrument $instrument)
    {
        $this->authorize('update', $instrument);

        $this->instrumentService->update($instrument, $request->validated());

        return redirect()
            ->route('instruments.index')
            ->with('success', 'اطلاعات ساز با موفقیت ویرایش شد.');
    }

    public function destroy(Instrument $instrument)
    {
        $this->authorize('delete', $instrument);

        $this->instrumentService->delete($instrument);

        return redirect()
            ->route('instruments.index')
            ->with('success', 'ساز با موفقیت حذف شد.');
    }
}

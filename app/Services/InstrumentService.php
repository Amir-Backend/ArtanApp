<?php

namespace App\Services;

use App\Models\Instrument;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class InstrumentService
{
    /**
     * لیست صفحه‌بندی‌شده‌ی سازها.
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return Instrument::query()->latest()->paginate($perPage);
    }

    /**
     * تمام سازهای فعال (برای استفاده در select باکس‌ها).
     */
    public function allActive()
    {
        return Instrument::query()->where('status', 'active')->orderBy('name')->get();
    }

    /**
     * ثبت ساز جدید.
     */
    public function create(array $data): Instrument
    {
        return DB::transaction(fn () => Instrument::create($data));
    }

    /**
     * ویرایش اطلاعات ساز.
     */
    public function update(Instrument $instrument, array $data): Instrument
    {
        DB::transaction(function () use ($instrument, $data) {
            $instrument->update($data);
        });

        return $instrument->refresh();
    }

    /**
     * حذف نرم (Soft Delete) ساز.
     */
    public function delete(Instrument $instrument): bool
    {
        return $instrument->delete();
    }

    /**
     * بازگردانی ساز حذف‌شده.
     */
    public function restore(Instrument $instrument): bool
    {
        return $instrument->restore();
    }
}

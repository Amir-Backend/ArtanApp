<?php

namespace Tests\Unit;

use App\Models\Teacher;
use App\Services\TeacherService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TeacherService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new TeacherService();
    }

    public function test_it_creates_a_teacher(): void
    {
        $teacher = $this->service->create([
            'first_name' => 'رضا',
            'last_name' => 'کریمی',
            'national_code' => '9876543210',
        ]);

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'national_code' => '9876543210',
        ]);
    }

    public function test_it_updates_a_teacher(): void
    {
        $teacher = Teacher::factory()->create(['first_name' => 'قدیمی']);

        $updated = $this->service->update($teacher, ['first_name' => 'جدید']);

        $this->assertSame('جدید', $updated->first_name);
    }

    public function test_it_soft_deletes_a_teacher(): void
    {
        $teacher = Teacher::factory()->create();

        $this->service->delete($teacher);

        $this->assertSoftDeleted('teachers', ['id' => $teacher->id]);
    }

    public function test_it_restores_a_soft_deleted_teacher(): void
    {
        $teacher = Teacher::factory()->create();
        $teacher->delete();

        $this->service->restore($teacher);

        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'deleted_at' => null,
        ]);
    }

    public function test_it_paginates_teachers(): void
    {
        Teacher::factory()->count(20)->create();

        $result = $this->service->paginate(10);

        $this->assertCount(10, $result->items());
        $this->assertEquals(20, $result->total());
    }
}

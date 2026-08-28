<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentServiceTest extends TestCase
{
    use RefreshDatabase;

    protected StudentService $service;

    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new StudentService();
    }

    public function test_it_creates_a_student(): void
    {
        $student = $this->service->create([
            'first_name' => 'علی',
            'last_name' => 'رضایی',
            'national_code' => '9876543210',
            'gender' => 'male',
        ]);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'national_code' => '9876543210',
        ]);
    }

    public function test_it_updates_a_student(): void
    {
        $student = Student::factory()->create(['first_name' => 'قدیمی']);

        $updated = $this->service->update($student, ['first_name' => 'جدید']);

        $this->assertSame('جدید', $updated->first_name);
    }

    public function test_it_soft_deletes_a_student(): void
    {
        $student = Student::factory()->create();

        $this->service->delete($student);

        $this->assertSoftDeleted('students', ['id' => $student->id]);
    }

    public function test_it_restores_a_soft_deleted_student(): void
    {
        $student = Student::factory()->create();
        $student->delete();

        $this->service->restore($student);

        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'deleted_at' => null,
        ]);
    }

    public function test_it_paginates_students(): void
    {
        Student::factory()->count(20)->create();

        $result = $this->service->paginate(10);

        $this->assertCount(10, $result->items());
        $this->assertEquals(20, $result->total());
    }
}

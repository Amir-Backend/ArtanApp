<?php

namespace Tests\Feature;

use App\Models\Teacher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeacherControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_teachers_index_page_loads_successfully(): void
    {
        Teacher::factory()->count(3)->create();

        $response = $this->get(route('teachers.index'));

        $response->assertOk();
        $response->assertViewIs('teachers.index');
        $response->assertViewHas('teachers');
    }

    public function test_create_page_loads_successfully(): void
    {
        $response = $this->get(route('teachers.create'));

        $response->assertOk();
    }

    public function test_a_teacher_can_be_created(): void
    {
        $payload = [
            'first_name' => 'رضا',
            'last_name' => 'کریمی',
            'phone' => '09120000000',
            'national_code' => '1234567890',
            'percentage' => 30,
            'features' => 'مدرس پیانو',
        ];

        $response = $this->post(route('teachers.store'), $payload);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('teachers', [
            'national_code' => '1234567890',
        ]);
    }

    public function test_creating_a_teacher_requires_mandatory_fields(): void
    {
        $response = $this->post(route('teachers.store'), []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'national_code',
        ]);
        $this->assertDatabaseCount('teachers', 0);
    }

    public function test_national_code_must_be_unique(): void
    {
        Teacher::factory()->create(['national_code' => '1111111111']);

        $response = $this->post(route('teachers.store'), [
            'first_name' => 'مریم',
            'last_name' => 'احمدی',
            'national_code' => '1111111111',
        ]);

        $response->assertSessionHasErrors(['national_code']);
        $this->assertDatabaseCount('teachers', 1);
    }

    public function test_a_teacher_can_be_viewed(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->get(route('teachers.show', $teacher));

        $response->assertOk();
        $response->assertSee($teacher->first_name);
    }

    public function test_a_teacher_can_be_updated(): void
    {
        $teacher = Teacher::factory()->create(['first_name' => 'قدیمی']);

        $response = $this->put(route('teachers.update', $teacher), [
            'first_name' => 'جدید',
            'last_name' => $teacher->last_name,
            'national_code' => $teacher->national_code,
        ]);

        $response->assertRedirect(route('teachers.index'));
        $this->assertDatabaseHas('teachers', [
            'id' => $teacher->id,
            'first_name' => 'جدید',
        ]);
    }

    public function test_a_teacher_can_be_soft_deleted(): void
    {
        $teacher = Teacher::factory()->create();

        $response = $this->delete(route('teachers.destroy', $teacher));

        $response->assertRedirect(route('teachers.index'));
        $this->assertSoftDeleted('teachers', ['id' => $teacher->id]);
    }
}

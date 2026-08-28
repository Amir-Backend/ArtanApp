<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StudentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_students_index_page_loads_successfully(): void
    {
        Student::factory()->count(3)->create();

        $response = $this->get(route('students.index'));

        $response->assertOk();
        $response->assertViewIs('students.index');
        $response->assertViewHas('students');
    }

    public function test_create_page_loads_successfully(): void
    {
        $response = $this->get(route('students.create'));

        $response->assertOk();
    }

    public function test_a_student_can_be_created(): void
    {
        $payload = [
            'first_name' => 'علی',
            'last_name' => 'رضایی',
            'national_code' => '1234567890',
            'gender' => 'male',
            'birth_date' => '2000-01-01',
            'phone' => '09120000000',
            'address' => 'تهران',
        ];

        $response = $this->post(route('students.store'), $payload);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'national_code' => '1234567890',
        ]);
    }

    public function test_creating_a_student_requires_mandatory_fields(): void
    {
        $response = $this->post(route('students.store'), []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'national_code',
            'gender',
        ]);
        $this->assertDatabaseCount('students', 0);
    }

    public function test_national_code_must_be_unique(): void
    {
        Student::factory()->create(['national_code' => '1111111111']);

        $response = $this->post(route('students.store'), [
            'first_name' => 'سارا',
            'last_name' => 'محمدی',
            'national_code' => '1111111111',
            'gender' => 'female',
        ]);

        $response->assertSessionHasErrors(['national_code']);
        $this->assertDatabaseCount('students', 1);
    }

    public function test_a_student_can_be_viewed(): void
    {
        $student = Student::factory()->create();

        $response = $this->get(route('students.show', $student));

        $response->assertOk();
        $response->assertSee($student->first_name);
    }

    public function test_a_student_can_be_updated(): void
    {
        $student = Student::factory()->create(['first_name' => 'قدیمی']);

        $response = $this->put(route('students.update', $student), [
            'first_name' => 'جدید',
            'last_name' => $student->last_name,
            'national_code' => $student->national_code,
            'gender' => $student->gender,
        ]);

        $response->assertRedirect(route('students.index'));
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'first_name' => 'جدید',
        ]);
    }

    public function test_a_student_can_be_soft_deleted(): void
    {
        $student = Student::factory()->create();

        $response = $this->delete(route('students.destroy', $student));

        $response->assertRedirect(route('students.index'));
        $this->assertSoftDeleted('students', ['id' => $student->id]);
    }
}

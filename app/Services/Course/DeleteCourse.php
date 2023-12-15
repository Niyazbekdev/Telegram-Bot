<?php

namespace App\Services\Course;
use App\Models\Course;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteCourse extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:courses,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $course = Course::findOrFail($data['id']);
        $course->delete();

        return true;
    }
}

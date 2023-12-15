<?php

namespace App\Services\Course;
use App\Models\Course;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class UpdateCourse extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:courses,id',
            'title' => 'required',
            'price' => 'required',
            'description' => 'nullable'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $course = Course::findOrFail($data['id']);
        $course->update([
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        return true;
    }
}

<?php

namespace App\Services\Course;
use App\Models\Course;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class CreateCourse extends BaseServices
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'price' => 'required',
            'description' => 'nullable',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        Course::create([
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);

        return true;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\CourseResource;
use App\Models\Course;
use App\Services\Course\CreateCourse;
use App\Services\Course\DeleteCourse;
use App\Services\Course\UpdateCourse;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class CourseController extends Controller
{
    use JsonRespondController;
    public function index(): AnonymousResourceCollection
    {
        $course = Course::get();
        return CourseResource::collection($course);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(CreateCourse::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function update(Request $request, string $course): JsonResponse
    {
        try {
            app(UpdateCourse::class)->execute([
                'id'=> $course,
                'title' => $request->title,
                'description' =>$request->description,
                'price' => $request->price,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function destroy(string $course): JsonResponse
    {
        try {
            app(DeleteCourse::class)->execute([
                'id' => $course,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}

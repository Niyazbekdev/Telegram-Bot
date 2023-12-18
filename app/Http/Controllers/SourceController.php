<?php

namespace App\Http\Controllers;

use App\Http\Resources\SourceResource;
use App\Models\Source;
use App\Services\Source\CreateSource;
use App\Services\Source\DeleteSource;
use App\Services\Source\UpdateSource;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class SourceController extends Controller
{
    use JsonRespondController;

    public function index(): AnonymousResourceCollection
    {
        $source = Source::get();
        return SourceResource::collection($source);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(CreateSource::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function update(Request $request, string $source): JsonResponse
    {
        try {
            app(UpdateSource::class)->execute([
                'id' => $source,
                'title' => $request->title,
                'type_id' => $request->type_id,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function destroy(string $source): JsonResponse
    {
        try {
            app(DeleteSource::class)->execute([
                'id' => $source,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}

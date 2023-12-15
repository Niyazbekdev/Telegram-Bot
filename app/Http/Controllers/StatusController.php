<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource;
use App\Models\Status;
use App\Services\Status\CreateStatus;
use App\Services\Status\DeleteStatus;
use App\Services\Status\UpdateStatus;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class StatusController extends Controller
{
    use JsonRespondController;

    public function index(): AnonymousResourceCollection
    {
        $status =  Status::get();
        return StatusResource::collection($status);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(CreateStatus::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return  $this->respondValidatorFailed($exception->validator);
        }
    }

    public function update(string $status, Request $request): JsonResponse
    {
        try {
            app(UpdateStatus::class)->execute([
                'id' => $status,
                'title' => $request->title,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }

    public function destroy(string $status): JsonResponse
    {
        try {
            app(DeleteStatus::class)->execute([
                'id' => $status,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}

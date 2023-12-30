<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\Telegram\ReplyToTheMessage;
use App\Traits\JsonRespondController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    use JsonRespondController;

    public function index()
    {
        return Message::get();
    }

    public function store(Request $request): JsonResponse
    {
        try {
            app(ReplyToTheMessage::class)->execute($request->all());
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}

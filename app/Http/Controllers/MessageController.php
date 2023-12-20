<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\Telegram\ReplyToTheMessage;
use App\Traits\JsonRespondController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MessageController extends Controller
{
    use JsonRespondController;

    public function index()
    {
        Message::get();
    }

    public function update(Request $request, string $message)
    {
        try {
            app(ReplyToTheMessage::class)->execute([
                'id' => $message,
                'text' => $request->text,
            ]);
            return $this->respondSuccess();
        }catch (ValidationException $exception){
            return $this->respondValidatorFailed($exception->validator);
        }
    }
}

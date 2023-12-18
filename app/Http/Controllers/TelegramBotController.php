<?php

namespace App\Http\Controllers;

use App\Http\Resources\TelegramChatResource;
use App\Services\Telegram\CreateBot;
use App\Services\Telegram\UpdateChatStatus;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Validation\ValidationException;

class TelegramBotController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $telegram = TelegraphChat::get();
        return TelegramChatResource::collection($telegram);
    }
    public function store(Request $request)
    {
        try {
            app(CreateBot::class)->execute($request->all());
            return response()->json([
                'Success' => true
            ]);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }

    public function update(Request $request, string $telegram)
    {
        try {
            app(UpdateChatStatus::class)->execute([
                'id' => $telegram,
                'status_id' => $request->status_id,
            ]);
            return true;
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
}

<?php

namespace App\Services\Telegram;
use App\Models\Message;
use App\Models\TelegraphChat;
use App\Services\BaseServices;
use App\Telegram\Handler;
use Illuminate\Validation\ValidationException;

class ReplyToTheMessage extends BaseServices
{
    public function rules(): array
    {
        return [
            'chat_id' => 'required|exists:telegraph_chats,id',
            'text' => 'required|string',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data, Handler $handler): bool
    {
        $this->validate($data);

        $chat = TelegraphChat::find($data['chat_id']);
        $chat->message($data['text'])->send();

        Message::create([
            'text' => $data['text'],
            'is_answered' => true,
        ]);

        return true;
    }
}

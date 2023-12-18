<?php

namespace App\Services\Telegram;
use App\Services\BaseServices;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Validation\ValidationException;

class UpdateChatStatus extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:telegraph_chats,id',
            'status_id' => 'required|exists:statuses,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $telegram = TelegraphChat::findOrFail($data['id']);
        $telegram->update([
            'status_id' => $data['status_id'],
        ]);

        return true;
    }
}

<?php

namespace App\Services;

use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Validation\ValidationException;

class CreateBot extends BaseServices
{
    public function rules(): array
    {
        return [
            'token' => 'required',
            'name' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);
        TelegraphBot::create([
            'token' => $data['token'],
            'name' => $data['name'],
        ]);
        return true;
    }
}

<?php

namespace App\Services\Status;
use App\Models\Status;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class CreateStatus extends BaseServices
{
    public function rules(): array
    {
        return [
            'title' => 'required',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        Status::create([
            'title' => $data['title'],
        ]);

        return true;
    }
}

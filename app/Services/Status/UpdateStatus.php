<?php

namespace App\Services\Status;
use App\Models\Status;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class UpdateStatus extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:statuses,id',
            'title' => 'required'
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $status = Status::findOrFail($data['id']);
        $status->update([
            'title' => $data['title'],
        ]);

        return true;
    }
}

<?php

namespace App\Services\Source;
use App\Models\Source;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class DeleteSource extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:sources,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $source = Source::findOrFail($data['id']);
        $source->delete();

        return true;
    }
}

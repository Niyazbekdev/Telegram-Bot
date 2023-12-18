<?php

namespace App\Services\Source;
use App\Models\Source;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class CreateSource extends BaseServices
{
    public function rules(): array
    {
        return [
            'title' => 'required',
            'type_id' => 'required|exists:source_types,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        Source::create([
            'title' => $data['title'],
            'source_type_id' => $data['type_id'],
        ]);
        return true;
    }
}

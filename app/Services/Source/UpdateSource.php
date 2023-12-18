<?php

namespace App\Services\Source;
use App\Models\Source;
use App\Services\BaseServices;
use Illuminate\Validation\ValidationException;

class UpdateSource extends BaseServices
{
    public function rules(): array
    {
        return [
            'id' => 'required|exists:sources,id',
            'title' => 'required',
            'type_id' => 'required|exists:sourcecl_types,id',
        ];
    }

    /**
     * @throws ValidationException
     */
    public function execute($data): bool
    {
        $this->validate($data);

        $source = Source::findOrFail($data['id']);
        $source->update([
            'title' => $data['title'],
            'source_type_id' => $data['type_id'],
        ]);

        return true;
    }
}

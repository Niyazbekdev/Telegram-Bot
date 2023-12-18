<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'source_type_id'];

    public function sourceType(): BelongsTo
    {
        return $this->belongsTo(SourceType::class);
    }
}

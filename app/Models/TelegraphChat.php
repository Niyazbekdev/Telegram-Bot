<?php

namespace App\Models;

use DefStudio\Telegraph\Models\TelegraphChat as BaseModel;

class TelegraphChat extends BaseModel
{
    protected $fillable = [
        'chat_id',
        'name',
        'phone',
        'status_id',
        'bot_state',
        'commentary',
        'telegraph_bot_id',
        'page',
    ];

    protected $casts = [
        'page' => 'integer',
    ];
}

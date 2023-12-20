<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'telegraph_chat_id',
        'telegraph_bot_id',
        'text',
        'answer',
    ];
}

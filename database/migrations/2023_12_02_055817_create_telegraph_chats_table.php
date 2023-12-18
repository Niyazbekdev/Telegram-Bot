<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('telegraph_chats', function (Blueprint $table) {
            $table->id();
            $table->string('chat_id');
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('status_id')->nullable()->constrained('statuses')->nullOnDelete();
            $table->string('bot_state')->nullable();
            $table->text('commentary')->nullable();
            $table->foreignId('telegraph_bot_id')->constrained('telegraph_bots')->cascadeOnDelete();
            $table->unsignedTinyInteger('page')->default(\App\Enums\Telegram\Page::main->value);
            $table->timestamps();

            $table->unique(['chat_id', 'telegraph_bot_id']);
        });
    }
};

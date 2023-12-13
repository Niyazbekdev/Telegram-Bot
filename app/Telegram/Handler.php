<?php

namespace App\Telegram;

use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function hello()
    {
        $this->reply('salem bul menin birinshi laravelde islegen telegram bot');
    }

    public function help()
    {
        $this->reply('Bul botta siz ozinizge kerekli bolgan sabaqliqlardi tawsaniz boladi');
    }

    public function actions(): void
    {
        $this->chat->message('Birewin saylan')
            ->keyboard(Keyboard::make()->buttons([
                Button::make('Saytqa otiw')->url('backenddev.uz'),
                Button::make('Layk basin')->action('like'),
                Button::make('Tirkelip ketin')->action('subscribe')
            ]))->send();
    }

    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() === '/start'){
            $this->reply('Assalawma aleykum botimizda kelgeniniz ushin quwanishliman');
        } else {
            $this->reply('Belgisiz komanda');
        }
    }
}

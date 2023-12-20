<?php

namespace App\Telegram;

use App\Enums\Telegram\Page;
use App\Models\Message;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler
{
    public function start(): void
    {
        if ($this->chat->phone == null) {
            $this->requestPhoneNumberPage();
        } else {
            $this->mainPage('Bas menu');
        }
    }

    public function handleChatMessage(Stringable $text): void
    {
        match ($this->chat->page) {
            Page::main->value => $this->main($text),
            Page::request_phone->value => $this->updatePhoneNumber(),
            Page::sen_message->value => $this->inputMessage($text)
        };
    }

    public function main(string $text): void
    {
        match ($text) {
            'biz haqqimizda' => $this->aboutPage(),
            'xabar jiberiw' => $this->sendMessage(),
            'arqaga qaytiw' => $this->backToMenu(),
            default => $this->mainPage('qate buyriq'),
        };
    }

    public function mainPage(string $keyboard): void
    {
        $this->chat->message($keyboard)
            ->replyKeyboard(ReplyKeyboard::make()
                ->row([
                    ReplyButton::make('biz haqqimizda'),
                ])
                ->row([
                    ReplyButton::make('Telegram kanal'),
                    ReplyButton::make('xabar jiberiw')
                ])
                ->row([
                    ReplyButton::make('menin biletlerim'),
                    ReplyButton::make('manzil')
                ])
            )->send();
    }

    private function updatePhoneNumber(): void
    {
        if (! empty($this->message->contact())) {
            $contactUserId = $this->message->contact()->userId();
            $senderId = $this->message->from()->id();

            if ($contactUserId == $senderId) {
                $phone = preg_replace('/[^0-9]/', '', $this->message->contact()->phoneNumber());

                $this->chat->update([
                    'phone' => '+' . $phone,
                ]);

                $this->setPage(Page::main->value);
                $this->mainPage('Bas Menu');
            } else {
                $this->requestPhoneNumberPage();
            }
        } else {
            $this->requestPhoneNumberPage();
        }
    }

    private function requestPhoneNumberPage(): void
    {
        $this->setPage(Page::request_phone->value);

        $this->chat->message('Telefon nomerinizdi jiberin')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make('Send phone number')->requestContact(),
            ]))->send();
    }

    public function aboutPage():void
    {
        $this->reply('Lorem ipsum dolor colour where about this what time want data have create');
        $this->setPage(Page::main->value);
    }

    public function sendMessage(): void
    {
        $this->chat->message('oz xabarinizdi jazip jiberin')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make('arqaga qaytiw'),
            ]))->send();

        $this->setPage(Page::sen_message->value);
    }

    public function inputMessage(string $text): void
    {
        if ($text != 'arqaga qaytiw') {
            Message::create([
                'telegraph_chat_id' => $this->chat->id,
                'telegraph_bot_id' => $this->bot->id,
                'text' => $text,
            ]);
            $this->mainPage('Sizge tez arada juwap qaytaramiz');
        }
        $this->backToMenu();
    }

    public function backToMenu():void
    {
        $this->setPage(Page::main->value);
        $this->mainPage('Bas menu');
    }

    private function setPage(int $page): void
    {
        $this->chat->update(['page' => $page]);
    }


}

<?php

namespace App\Telegram;

use App\Enums\Telegram\Page;
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
            $this->mainPage();
        }
    }

    public function handleChatMessage(Stringable $text): void
    {
        match ($this->chat->page) {
            Page::main->value => $this->main($text),
            Page::request_phone->value => $this->updatePhoneNumber()
        };
    }

    public function main(Stringable $text): void
    {
        match ($text) {
            default => $this->mainPage()
        };
    }

    public function mainPage(): void
    {
        $this->chat->message('Bas menyu')
            ->replyKeyboard(ReplyKeyboard::make()->buttons([
                ReplyButton::make('foo')->requestPoll(),
                ReplyButton::make('bar')->requestQuiz(),
                ReplyButton::make('baz')->webApp('https://webapp.dev'),
            ]))->send();
        $this->setPage(Page::request_phone->value);
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
                $this->mainPage();
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

    private function setPage(int $page): void
    {
        $this->chat->update(['page' => $page]);
    }
}

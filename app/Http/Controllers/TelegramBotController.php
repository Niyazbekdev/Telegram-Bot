<?php

namespace App\Http\Controllers;

use App\Services\CreateBot;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TelegramBotController extends Controller
{
    public function store(Request $request)
    {
        try {
            app(CreateBot::class)->execute($request->all());
            return response()->json([
                'Success' => true
            ]);
        }catch (ValidationException $exception){
            return $exception->validator->errors()->all();
        }
    }
}

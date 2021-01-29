<?php

namespace App\Http\Controllers\API;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;

class EmailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        $payload = $request->validated();
        event(new SendEmailEvent($payload));
        return "Done";
    }
}

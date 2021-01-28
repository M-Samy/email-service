<?php

namespace App\Http\Controllers\API;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Jobs\SendMails;
use App\Models\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        $payload = [
            "to" => ["msamy@admin.com"],
            "subject" => "test",
            "message" => "testeeen"
        ];
        event(new SendEmailEvent($payload));

//        dispatch(new SendMails($payload));

        return "Done";
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Http\Resources\Emails\BatchEmailResponse;
use App\Http\Resources\Emails\Payload;
use App\Jobs\SendMails;
use Illuminate\Support\Facades\Bus;

class EmailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        $payload = $request->validated();
        $to = $payload["to"];
        $subject = $payload["subject"];
        $message = $payload["message"];

        $emailPayload = new Payload($to, $subject, $message);


        // The first method depending on event and listener.
        // event(new SendEmailEvent($emailPayload));

        // **********************************************************

        // The Second method depending on batch jobs to detect failures.
        $batch = Bus::batch([
            new SendMails($emailPayload)
        ])->allowFailures()->dispatch();

        return new BatchEmailResponse($batch);
    }

    public function batch()
    {
        $batchId = request('batchId');
        return Bus::findBatch($batchId);
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Events\SendEmailEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use App\Jobs\SendMails;
use Illuminate\Support\Facades\Bus;

class EmailController extends Controller
{
    public function send(SendEmailRequest $request)
    {
        $payload = $request->validated();
        // The first method depending on event and listener.
        // event(new SendEmailEvent($payload));

        // **********************************************************

        // The Second method depending on batch jobs to detect failures.
        $batch = Bus::batch([
            new SendMails($payload)
        ])->allowFailures()->dispatch();

        return $batch->id;
    }

    public function batch()
    {
        $batchId = request('batchId');
        return Bus::findBatch($batchId);
    }
}

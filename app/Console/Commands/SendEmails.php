<?php

namespace App\Console\Commands;

use App\Http\Resources\Emails\Payload;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending emails to the users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $to = $this->ask('Email recipients');
        $subject = $this->ask('Email subject');
        $message = $this->ask('Email message');

        $validationErrors = $this->requestValidation($to, $subject, $message);

        if (count($validationErrors)) {
            $this->info("Email request is invalid");

            foreach ($validationErrors as $error) {
                $this->error($error);
            }
        }

        $emailRequestPayload = $this->buildRequestPayload($to, $subject, $message);
    }

    public function requestValidation($to, $subject, $message)
    {
        $validator = Validator::make([
            'to' => $to,
            'message' => $message,
            'subject' => $subject
        ], [
            'to' => ['required', 'array'],
            'message' => ['required'],
            'subject' => ['required'],
        ]);

        return $validator->errors()->all();
    }

    public function buildRequestPayload($to, $subject, $message)
    {
        $emailPayload = new Payload($to, $subject, $message);
        return $emailPayload;
    }
}

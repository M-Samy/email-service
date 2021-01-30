<?php


namespace App\Http\Resources\Emails;

class Payload
{
    private $toAddresses;
    private $subject;
    private $message;

    public function get_toAddress()
    {
        return $this->toAddresses;
    }

    public function set_toAddress($to_addresses)
    {
        $this->toAddresses = $to_addresses;
    }

    public function get_subject()
    {
        return $this->subject;
    }

    public function set_subject($subject)
    {
        $this->subject = $subject;
    }

    public function get_message()
    {
        return $this->message;
    }

    public function set_message($message)
    {
        $this->message = $message;
    }
}
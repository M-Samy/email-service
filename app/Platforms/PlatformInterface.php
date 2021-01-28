<?php


namespace App\Platforms;


interface PlatformInterface
{
    public function sendEmail($payload);
}
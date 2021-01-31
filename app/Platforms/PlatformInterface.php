<?php


namespace App\Platforms;


interface PlatformInterface
{
    public static function sendEmail($payload);
    public static function buildTemplate($payload);
    public static function initConnectionClient();
    public static function getPlatformName();

}
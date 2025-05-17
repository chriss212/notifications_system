<?php

namespace App;

class SMsNotification extends AbstractNotificationMethod
{
    public $phone_number;
    public $area;
    public function __construct(int $phone_number, int $area)
    {
        $this->phone_number = $phone_number;
        $this->area = $area;
    }
    public function sendNotification(): string
    {
        return "Sent to {$this->contact} SMS message to +$this->area $this->phone_number";
    }
}

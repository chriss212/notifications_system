<?php

namespace App;

class EmailNotification extends AbstractNotificationMethod
{
    public $email_address;
    public function __construct(string $email_address)
    {
        $this->email_address = $email_address;
    }
    
    public function sendNotification(): string {

        return "Sent to {$this->contact} email to $this->email_address";
    }
}

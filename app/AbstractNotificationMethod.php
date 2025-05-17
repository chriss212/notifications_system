<?php

namespace App;

abstract class AbstractNotificationMethod implements NotificationMethodInterface
{
    protected string $contact;

    public function setReceiver(string $contact): void 
    {
        $this->contact = $contact;
    }
}

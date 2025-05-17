<?php

namespace App;

interface NotificationMethodInterface
{
    public function sendNotification(): string;
}

<?php

namespace App\Http\Controllers;

use App\EmailNotification;
use App\NotificationMethodInterface;
use App\SMsNotification;
use App\WhatsAppNotification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
        public function process(Request $request)
    {
        $request->validate([
            'notification_method' => 'required|in:email,whatsapp,sms',
            'contact' => 'required|string|max:255',
            'email_address' => 'required_if:notification_method,email|email|max:255',
            'phone_number' => 'required_if:notification_method,sms|regex:/^[0-9]{8}$/', //El numero de telefono debe tener 8 digitos
            'area' => 'required_if:notification_method,sms|regex:/^\d{3}$/',
        ]);

        $contact = $request->input('contact');

        $notificationMethod = match ($request->input('notification_method')) {
            'email' => new EmailNotification($request->input('email_address')),
            'sms' => new SMsNotification($request->input('phone_number'), $request->input('area')),
            'whatsapp' => new WhatsAppNotification($request->input('phone_number'), $request->input('area')),
        };

        $notificationMethod->setReceiver($contact);

        return $this->handleNotification($contact, $notificationMethod);
    }

    private function handleNotification(string $contact, NotificationMethodInterface $notificationMethod)
    {
        return response()->json([
            'message' => $notificationMethod->sendNotification(),
        ]);
    }
}

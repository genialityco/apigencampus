<?php

namespace App\evaLib\Services;

//Models
// Google cloud
use Mail;

/**
 * Undocumented class
 */
class AdministratorService
{
    public static function notificationAdmin($rol, $email, $event, $names, $request)
    {
        if ($rol === config('app.rol_admin')) {
            $urlOrigin = $request->header('origin');
            Mail::to($email)
                ->queue(
                    new \App\Mail\AdministratorMail($email, $event, $names, $urlOrigin)
                );
        }
        return;
    }
}

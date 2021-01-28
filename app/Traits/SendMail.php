<?php

namespace App\Traits;
use Illuminate\Support\Facades\Mail;

trait SendMail {

    public function sendMails($heading, $message, $site_name, $base_url, $userEmail){

        $details = [

            'heading' => $heading,
            'message' => $message,
            'site_name' => $site_name,
            'base_url' => $base_url,

        ];

        Mail::to($userEmail)->send(new \App\Mail\sendMail($details));
    }

}
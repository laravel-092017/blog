<?php

namespace App\Listeners;

use App\Events\FeedbackWasCreated;
use App\Mail\FeedbackMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class FeedbackMailNotify
{
    public function handle(FeedbackWasCreated $event)
    {
        $data = $event->getInputData();

        Mail::to(env('MAIL_TO'))
            ->send(new FeedbackMail($data));
    }
}

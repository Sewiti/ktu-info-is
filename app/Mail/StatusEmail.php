<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $order;
    private $user;
    private $status;

    public function __construct($order, $user, $status)
    {
        $this->order = $order;
        $this->user = $user;
        $this->status = $status;
    }

    public function build()
    {
        if($this->status->sortByDesc('atnaujinimo_laikas')->first()->busena == 1) {
            $string = "neapmokėta";
        } else {
            $string = "apmokėta";
        }
        return $this->subject('#'.$this->order->id.' Užsakymo būsenos pasikeitimas - '.$string)->view('email.status', ['order' => $this->order, 'user' => $this->user, 'status' => $this->status]);
    }
}

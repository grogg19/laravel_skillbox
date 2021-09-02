<?php

namespace App\Mail\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTotalReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reportItems;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $reportItems)
    {
        $this->reportItems = $reportItems;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.total-report-list');
    }
}

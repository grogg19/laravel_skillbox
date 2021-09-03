<?php

namespace App\Mail\Reports;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTotalReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reportItems;
    public $pathToFile;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $reportItems, string $pathToFile)
    {
        $this->reportItems = $reportItems;
        $this->pathToFile = $pathToFile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.total-report-list')->attach(storage_path('app/public/' . $this->pathToFile));
    }
}

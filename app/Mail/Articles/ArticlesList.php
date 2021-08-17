<?php

namespace App\Mail\Articles;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class ArticlesList extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Collection
     */
    public $articles;

    /**
     * Create a new message instance.
     * @param Collection $articles
     */
    public function __construct(Collection $articles)
    {
        $this->articles = $articles;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.articles-list');
    }
}

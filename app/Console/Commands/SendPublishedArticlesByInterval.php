<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SendListArticlesForUsersByPeriod;
use App\Repositories\ArticleRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Ramsey\Collection\Collection;

class SendPublishedArticlesByInterval extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:send_by_interval {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправление уведомлений о новых статьях, опубликованных в определенном интервале';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle(ArticleRepositoryInterface $articleRepository, Carbon $from, Carbon $to)
    {
        $from->setTimezone("Europe/Moscow");
        $to->setTimezone("Europe/Moscow");

        !empty($this->argument('from'))
            ? $from->setDateTimeFrom($this->argument('from'))->startOfDay()
            : $from->subWeek()->startOfDay();

        $to->setDateTimeFrom($this->argument('to'))->endOfDay();

        $articles = $articleRepository->getPublishedArticlesByDateInterval($from, $to);

        if(!$articles->isEmpty()) {
            $subject = 'Список новых опубликованных статей за период с ' . $from->format('d.m.Y') . ' до ' . $to->format('d.m.Y');
            User::all()->map->notify(new SendListArticlesForUsersByPeriod($subject, $articles));

            $this->info("Уведомления успешно отправлены.");
        } else {
            $this->info("Новых статей в заданный период не публиковалось.");
        }

    }
}

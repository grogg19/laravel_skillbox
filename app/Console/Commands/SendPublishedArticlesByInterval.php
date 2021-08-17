<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\SendListArticlesForUsersByPeriod;
use App\Repositories\ArticleRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Console\Command;

class SendPublishedArticlesByInterval extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'articles:send_by_interval';
    protected $signature = 'articles:send_by_interval {from?} {to?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


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
    public function handle(ArticleRepositoryInterface $articleRepository)
    {
        $from = !empty($this->argument('from'))
            ? Carbon::createFromFormat("d.m.Y", $this->argument('from'), 'Europe/Moscow')->setTime(0, 0, 0)->toDateString()
            : Carbon::now()->setTimezone("Europe/Moscow")->subDay(7)->setTime(0,0,0)->toDateString();

        $to = !empty($this->argument('to'))
            ? Carbon::createFromFormat('d.m.Y', $this->argument('to'), 'Europe/Moscow')->setTime(23,59,59)->toDateString()
            : Carbon::now()->setTimezone('Europe/Moscow')->toDateString();

        $articles = $articleRepository->getPublishedArticlesByDateInterval($from, $to);

        if(!empty($articles)) {
            $subject = 'Список новых опубликованных статей за период с ' . Carbon::parse($from)->format("d.m.Y") . ' до ' . Carbon::parse($to)->format('d.m.Y');
            User::all()->map->notify(new SendListArticlesForUsersByPeriod($subject, $articles));
        }

        $this->info("Уведомления успешно отправлены.");
    }
}

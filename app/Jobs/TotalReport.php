<?php

namespace App\Jobs;

use App\Mail\Mail\SendTotalReport;
use App\Models\User;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class TotalReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $receiverReport;

    protected $reportTypes;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, Collection $reportTypes)
    {
        $this->receiverReport = $user;
        $this->reportTypes = $reportTypes;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(
        ArticleRepositoryInterface $articleRepository,
        NewsRepositoryInterface $newsRepository,
        UserRepositoryInterface $userRepository,
        TagRepositoryInterface $tagRepository,
        CommentRepository $commentRepository
    )
    {

        $reportItems = new Collection();

        if ($this->reportTypes->has('articles')) {
            $reportItems->put('articles', [
                'title' => 'Статей',
                'value' => $articleRepository->getAllArticlesCount()
            ]);
        }

        if ($this->reportTypes->has('news')) {
            $reportItems->put('news', [
                'title' => 'Новостей',
                'value' => $newsRepository->getAllNewsCount()
            ]);
        }

        if ($this->reportTypes->has('tags')) {
            $reportItems->put('tags', [
                'title' => 'Тегов',
                'value' => $tagRepository->getAllTagsCount()
            ]);
        }

        if ($this->reportTypes->has('users')) {
            $reportItems->put('users', [
                'title' => 'Пользователей',
                'value' => $userRepository->getAllUsersCount()
            ]);
        }

        if ($this->reportTypes->has('comments')) {
            $reportItems->put('comments', [
                'title' => 'Комментариев',
                'value' => $commentRepository->getAllCommentsCount()
            ]);
        }

        Mail::to($this->receiverReport->email)->send(
            new SendTotalReport($reportItems)
        );
    }
}

<?php

namespace App\Jobs;

use App\Events\ReportGenerated;
use App\Exports\ReportExport;
use App\Mail\Reports\SendTotalReport;
use App\Models\User;
use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\CommentRepository;
use App\Repositories\NewsRepositoryInterface;
use App\Repositories\TagRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Services\CreateExcelFile;

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
        CommentRepository $commentRepository,
        CreateExcelFile $createExcelFile
    )
    {
        $reportItems = [];

        if ($this->reportTypes->has('articles')) {
            $reportItems[] = [
                'title' => 'Статей',
                'value' => $articleRepository->getAllArticlesCount()
            ];
        }

        if ($this->reportTypes->has('news')) {
            $reportItems[] = [
                'title' => 'Новостей',
                'value' => $newsRepository->getAllNewsCount()
            ];
        }

        if ($this->reportTypes->has('tags')) {
            $reportItems[] = [
                'title' => 'Тегов',
                'value' => $tagRepository->getAllTagsCount()
            ];
        }

        if ($this->reportTypes->has('users')) {
            $reportItems[] = [
                'title' => 'Пользователей',
                'value' => $userRepository->getAllUsersCount()
            ];
        }

        if ($this->reportTypes->has('comments')) {
            $reportItems[] = [
                'title' => 'Комментариев',
                'value' => $commentRepository->getAllCommentsCount()
            ];
        }

        $data = collect($reportItems);

        event(new ReportGenerated($this->receiverReport, $data));

        $file = $createExcelFile->create(new ReportExport($data));

        Mail::to($this->receiverReport->email)->send(
            new SendTotalReport($data, $file)
        );
    }

}

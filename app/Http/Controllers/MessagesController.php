<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreMessageRequest;
use App\Repositories\MessageRepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessagesController extends Controller
{
    /**
     * @var MessageRepositoryInterface
     */
    private $messagesRequest;

    /**
     * MessagesController constructor.
     * @param MessageRepositoryInterface $messagesRequest
     */
    public function __construct(MessageRepositoryInterface $messagesRequest)
    {
        $this->messagesRequest = $messagesRequest;
    }

    /**
     * Display a listing of the messages.
     *
     * @return View
     */
    public function index(): View
    {
        $messages = Cache::tags(['messages'])->remember('messages',3600 * 24, function () {
            return $this->messagesRequest->listMessages();
        });

        return view('feedback', compact('messages'));
    }

    /**
     * Show the form for creating a new message.
     * @return View
     */
    public function create(): View
    {
        return view('messages.create');
    }

    /**
     * Store a newly created message in storage.
     * @param StoreMessageRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreMessageRequest $request)
    {

        $resultValidation = $request->validated();

        $this->messagesRequest->createMessage($resultValidation);

        return redirect(route('page.feedback'));
    }
}

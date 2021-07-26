<?php

namespace App\Http\Controllers;

use App\Repositories\MessageType;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * Class MessageController
 * @package App\Http\Controllers
 */
class MessagesController extends Controller
{
    /**
     * @var MessageType
     */
    private $messagesStorage;

    /**
     * MessagesController constructor.
     * @param MessageType $messagesStorage
     */
    public function __construct(MessageType $messagesStorage)
    {
        $this->messagesStorage = $messagesStorage;
    }

    /**
     * Display a listing of the messages.
     *
     * @return View
     */
    public function index(): View
    {
        $messages = $this->messagesStorage->listMessages();
        $title = 'Список обращений';

        return view('feedback', compact('messages', 'title'));
    }

    /**
     * Show the form for creating a new message.
     * @return View
     */
    public function create(): View
    {
        $title = 'Отправить сообщение ';
        return view('messages.create', compact('title'));
    }

    /**
     * Store a newly created message in storage.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'body' => 'required',
        ];

        $this->validate($request, $rules);

        $this->messagesStorage->createMessage($request->post());

        return redirect('/feedback');
    }
}

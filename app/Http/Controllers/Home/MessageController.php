<?php

namespace App\Http\Controllers\Home;

use Auth;
use DDL\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DDL\Repositories\MessageRepository;

class MessageController extends Controller
{


    protected $messageRepository;


    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }



    /**
     * 个人消息进入界面
     */
    public function index()
    {
        $user = Auth::user();
        $messages = $user->messages;
        return view('home.message.message')->with('personMessages', $messages);
    }


}

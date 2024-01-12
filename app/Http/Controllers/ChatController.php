<?php

namespace App\Http\Controllers;

use App\Events\NewMessageNotification;
use App\Events\SendChatMessage;
use App\Http\Requests\ChatMessageRequest;
use App\Models\Chat;
use App\Repositories\ChatMessageRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function __construct(protected ChatMessageRepository $repository, protected UserRepository $userRepository)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('chat.index', [

        ]);
    }

    public function send(ChatMessageRequest $request)
    {
        $data = $request->validated();
        try {
            $data['from'] = Auth::user()->id;
            $message = $this->repository->create($data);

            event(new SendChatMessage($message));

            return response()->json(['status' => true, 'data' => null]);
        } catch (Exception $e) {
            return response()->json(['status' =>false, 'message' => $e->getMessage()]);
        }
    }

    public function getChatMessages(int $chat_user_id)
    {
        try {
            $messages = $this->repository->getUserMessages($chat_user_id);
            $selectedUser = $this->userRepository->getOne($chat_user_id);

            return response()->json([
                'status' => true,
                'data' => [
                    'messages' => $messages,
                    'user' => $selectedUser
                    ]
                ]);

        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatMessageRepository extends BaseRepository
{
    public function __construct(Message $model)
    {
        $this->model = $model;
    }

    public function getUserMessages(int $chatUserId)
    {
        abort_if(!Auth::check(), 401, 'Unauthorized');

        $userId = Auth::user()->id;

        return $this->model::query()->where(function ($query) use ($userId, $chatUserId) {
            $query->where('from', $userId)
                ->where('to', $chatUserId);
        })
        ->orWhere(function ($query) use ($userId, $chatUserId) {
            $query->where('from', $chatUserId)
                ->where('to', $userId);
        })
        ->orderBy('created_at')
        ->get();
    }
}

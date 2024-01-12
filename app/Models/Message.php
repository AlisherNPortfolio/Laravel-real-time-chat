<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from', 'to', 'message', 'has_read'];

    protected $casts = [
        'has_read' => 'boolean',
    ];

    protected $with = ['sender', 'receiver'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'from');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'to');
    }
}

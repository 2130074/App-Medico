<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'user_id',
        'message',
    ];

    // Relación con Notification
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

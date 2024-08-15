<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'doctor_id',
        'message',
        'pdf_path',
        'is_read',
    ];

    /**
     * The relationships between Notification and Doctor.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Relación con Reply
    public function replies()
    {
        return $this->hasMany(Reply::class);
    }
}

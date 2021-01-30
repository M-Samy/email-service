<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Email extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = ['to', 'subject', 'message', 'markdown', 'platform'];

    protected $casts = [
        'to' => 'array',
        'platform' => 'array'
    ];

}

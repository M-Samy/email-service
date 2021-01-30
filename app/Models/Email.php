<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Email extends Model implements Transformable
{
    use TransformableTrait, HasFactory, Notifiable;

    protected $fillable = ['to', 'subject', 'message', 'markdown', 'platform'];

}

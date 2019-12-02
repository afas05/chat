<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Message extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'chat_id', 'user_id', 'text', 'date'
    ];
}

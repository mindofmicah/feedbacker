<?php
namespace MindOfMicah\Feedbacker\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;
use MindOfMicah\Feedbacker\Exceptions\InvalidArgumentException;

class Feedback extends Eloquent
{
    protected $fillable = [
        'email',
        'message'
    ];

}

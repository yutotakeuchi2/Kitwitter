<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowRequest extends Model
{
    protected $primary_key = [
        "follow_by",
        "following"
    ];
    protected $fillable = [
        "follow_by",
        "following"
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Follow extends Model
{
    protected $primary_key = [
        "follow_by",
        "following"
    ];
    protected $fillable = [
        "follow_by",
        "following"
    ];

    protected $table = "follow";

    public static function follow($follow_id){

    }
}

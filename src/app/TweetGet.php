<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TweetGet extends Model
{
    protected $table ='tweets';

    protected $guarded = array('id');

    public $timestamps = false;

    public function getData(){
        $data = DB::table($this->table)->get();
        return $data;
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpdateUser extends Model
{
    public function selectUserFindById($id)
    {

        $query = $this->select([
            'id',
            'name',
            'email'
        ])->where({
            'id'=> $id
        });

        return $query->first();
    }
}

<?php

namespace Chatty;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likeable';

    public function likeable(){
    	return $this->morphTo();// I can apply to any other model
    }
}

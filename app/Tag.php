<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        /**
     * Relation with Posts
     */
    // tags - posts
    public function posts(){
        return $this->belongsToMany('App\Post');
    }
}

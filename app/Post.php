<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'content',
    ];

    /**
     * Relation with Categories
     */
    // posts - categories
    public function category(){
        return $this->belongsTo('App\Category');
    }

    /**
     * Relation with Tags
     */
    // posts - tags
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
}

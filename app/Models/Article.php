<?php

namespace App\Models;

use System\Core\Model;

class Article extends Model
{
    protected string $table= 'articles';

    public function category()
    {
        return $this->related(Category::class,'categories','category_id','id','parent');

    }

    public function comments()
    {
        return $this->related(Comment::class,'comments','user_id');
    }

}
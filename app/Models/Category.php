<?php

namespace App\Models;

use System\Core\Model;

class Category extends Model
{
    protected string $table= 'categories';

    public function articles()
    {
        return $this->related(Article::class,'articles','article_id');

    }

}
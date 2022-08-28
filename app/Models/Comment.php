<?php

namespace App\Models;

use System\Core\Model;

class Comment extends Model
{
    protected string $table= 'comments';


    public function article()
    {
        return $this->related(Article::class,'articles','article_id','id','parent');
        
    }



}
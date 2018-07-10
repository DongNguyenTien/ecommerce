<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "news_comments";
    protected $guarded = [];
}

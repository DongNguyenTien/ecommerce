<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = "news_regions";
    protected $guarded =[];

    public function RegionCategory(){
        return $this->hasMany('Modules\News\Models\NewsCategory');
    }
}

<?php

namespace Modules\News\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Modules\Core\Models\Group;

class NewsPostView extends Model
{
    protected $table = "news_post_views";
    
    protected $fillable = [
        'post_id', 'user_id', 'created_at'
    ];
    
    /**
     * Report week
     * @return array
     */
    public function reportMonth(){
        $arrPast = array();
        $arrPast[] = date('Y-m-01');
        for ($i = 1; $i <= 11; $i++) {
            $arrPast[]  = date("Y-m-01", strtotime( date( 'Y-m-01' )." -$i months"));
        }
        
        $result = array();
        for ($i = count($arrPast) - 1; $i >=0 ; $i--){
            $result[date('Y-m', strtotime($arrPast[$i]))] = $this->countTransByDate($arrPast[$i]);
        }
        return $result;
    }
    
    /**
     * Count tran by date
     * @param $date
     * @return mixed
     */
    public function countTransByDate($date){
        
        return $this->query()->whereBetween('created_at', array(
            "{$date} 00:00:00", date("Y-m-t", strtotime($date)) . " 23:59:59"
        ))->count();
    }
}

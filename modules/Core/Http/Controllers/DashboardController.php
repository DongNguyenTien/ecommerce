<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\News\Models\NewsPost;
use Modules\News\Models\NewsPostView;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
    
        $newsPostView = new NewsPostView();
        $report = $newsPostView->reportMonth();
        
        $news = NewsPost::getMyNews(Auth::id())->limit(10)->orderby('id', 'DESC')->get();
        
        return view('core::index')->withReport($report)
            ->withLabels(implode(',', array_keys($report)))
            ->withNews($news);
    }

}

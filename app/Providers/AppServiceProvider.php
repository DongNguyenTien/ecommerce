<?php

namespace App\Providers;

use App\Libraries\CrmAPI;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->getMenus();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function getMenus()
    {
        $crmAPI = new CrmAPI();
        $result = [];
        //Product Category list
        $result['product'] = $crmAPI->getDataFromApi('/product/category');
        $result['product'] = $result['product']['data'];

        //News category list
        $result['news'] = $crmAPI->getDataFromApi('/news/categories');
        $result['news'] = $result['news']['data'];

//        Notifications
//        dd(Cookie::get('user'));
        if (Cookie::has('user') && !empty(Crypt::decrypt(Cookie::get('user')))) {
        
            $cookie = Crypt::decrypt(Cookie::get('user'));
            $cookie = \GuzzleHttp\json_decode($cookie,true);

            if (!empty($cookie['Authentication'])) {
                $params['headers'] = [
                    'Authorization' => $cookie['Authentication'],
                    'AppKey' => $cookie['AppKey']
                ];

                $result['notification'] = $crmAPI->getDataFromApi('/notifications/numberUnRead',$params);
                $result['notification'] = $result['notification']['data']['quantity'];
            }
        }

        View::share('menus',$result);
    }

}

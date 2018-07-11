<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CrmAPI;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class CrmController extends Controller
{

    protected $crmApi;

    public function __construct()
    {
        $this->crmApi = new CrmAPI();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        //List representation of each category product
        $crmAPI = new CrmAPI();

        //Product Category list
        $category_product = $crmAPI->getDataFromApi('/product/category');

        $listRepresentationOfEachProduct = [];
//        foreach($category_product['data'] as $category) {
//
//            $representation = $crmAPI->getDataFromApi('/product/list',[
//                'page' => '1',
//                'page_size' => 10,
//                'category_id' => $category['id']
//            ]);
//            $obj['data'] = $representation['data'][rand(0,count($representation['data'])-1)];
//            $obj['category'] = $category['name'];
//            $obj['category_id'] = $category['id'];
//            $listRepresentationOfEachProduct[] = $obj;
//        }
        return view('index.index',compact('listRepresentationOfEachProduct'));
    }


    /**
     * @param $category_id
     * @param int $page
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listProduct($category_id,$page = 1,Request $request)
    {
        $params = $request->all();

        $page_size = !empty($params['page_size'])?$params['page_size']:12;

        $crmAPI = new CrmAPI();
        $listProduct = $crmAPI->getDataFromApi('/product/list',[
            'page' => $page,
            'page_size' => $page_size,
            'category_id' => $category_id,
            'key' => !empty($params['key'])?$params['key']:''
        ]);

        $listProduct = $listProduct['data'];

        $totalRecord = $crmAPI->getDataFromApi('/product/extra',[
            'category_id'=>$category_id,
            'key' => !empty($params['key'])?$params['key']:''
        ]);

        //Category_name
        $category = $crmAPI->getDataFromApi('/product/category',[
            'category_id' => $category_id,
        ]);

        $category_name = !empty($category['data'])?$category['data'][0]['name']:"";
        $total_page = (int)ceil($totalRecord['data']/12);
        $from = 12*($page-1) + 1;
        $to = 12*$page;
        $key = !empty($params['key'])?$params['key']:'';

        return view('product.category',compact('listProduct','category_name','category_id','total_page','page','totalRecord','from','to','key'));
    }


    /**
     * @param $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function detailProduct($product_id)
    {
        $crmAPI = new CrmAPI();
        $product = $crmAPI->getDataFromApi('/product/detail',[
            'product_id' => $product_id,
        ]);

        //Relate products
        $listProduct = $crmAPI->getDataFromApi('/product/list',[
            'category_id' => $product['data']['category'][0]['id'],
        ]);

        $number_random = count($listProduct['data'])<3?count($listProduct['data']):3;
        $listProduct = array_random($listProduct['data'],$number_random);



        if(!empty($product)) {
            $product = $product['data'];
            //Product_name
            $product_name = $product['name'];
            return view('product.detailProduct',compact('product','product_id','product_name','listProduct'));
        } else {
            return redirect()->back()->with('messages','Something wrong');
        }
    }



    /**
     * @param $category_id
     * @param int $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listNews($category_id,$page = 1)
    {
        $crmApi = new CrmAPI();
        $news = $crmApi->getDataFromApi('/news/posts',[
            'category_id' => $category_id,
            'page' => $page,
            'page_size' => 9
        ]);


        $totalRecord = $crmApi->getDataFromApi('/news/extra',[
            'category_id'=>$category_id
        ]);


        if (!empty($totalRecord)) {
            $category_name = $totalRecord['data']['category_name'];
            $total_page = (int)ceil($totalRecord['data']['quantity']/9);
        }


        return view('news.blog',compact('news','category_name','category_id','total_page','page'));
    }


    /**
     * @param $post_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function newsDetail($post_id)
   {
       $newsDetail = $this->crmApi->getDataFromApi('/news/post/detail',[
           'post_id' => $post_id,
       ]);

       if (count($newsDetail['data']) != 0) {
           $news = $newsDetail['data'];
            return view('news.detail',compact('news'));
       } else {
           return view('component.pageNotFound');
       }
   }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   public function cart()
   {
       return view('product.cart');
   }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|null
     */
   public function checkout(Request $request)
   {
       $params = $request->all();

       $cookie = Cookie::get('user');
       $user = \GuzzleHttp\json_decode($cookie,true);

       $params['headers'] = [
           'Authorization' => $user['Authentication'],
           'AppKey' => $user['AppKey']
       ];

       $params['page_size'] = 6;
       $customer = [];

       if ($user['info']['member_type'] == 1) {

           $customer = $this->crmApi->getDataFromApi('/customer/list',$params);
           $customer = $customer['data'];
       }

       View::share('customer',$customer);
       View::share('user',$user);

       //Page, current page, total record
       $totalCustomer = $this->crmApi->getDataFromApi('/customer/total',$params);
       $max_page = ($totalCustomer['data']%6 != 0) ? (int)($totalCustomer['data']/6) + 1 : (int)($totalCustomer['data']/6);
       $current_page = !empty($params['page'])?$params['page']:1;

       $data['max_page'] = (int)$max_page;
       $data['current_page'] = (int)$current_page;
       $data['customer'] = $customer;




       if (!empty($params['flag'])) {
           return $data;
       }


       return view('product.checkout');
   }

    /**
     * @param Request $request
     */
   public function order(Request $request)
   {
       $params = $request->all();

       $cookie = Cookie::get('user');
       $cookie = \GuzzleHttp\json_decode($cookie,true);

       $params['headers'] = [
           'Authorization' => $cookie['Authentication'],
           'AppKey' => $cookie['AppKey']
       ];

       //Check customer or promoter
       if ($cookie['info']['member_type'] == 0) {
           //Validate billing
           //Billing date
           if (!empty($params['billing_date'])) {
               $params['billing_date'] = strtotime($params['billing_date']);
           }

           $validate = Validator::make($params,[
               'billing_name' => 'required',
               'billing_phone' => ['required','regex:/((\+?)84|0)\d{9,10}$/'],
               'billing_date' => 'nullable|numeric'
           ],[
               'billing_name.required' => 'Chưa nhập thông tin người mua hàng',
               'billing_phone.required' => 'Chưa nhập số điện thoại người mua hàng',
               'billing_phone.regex' => 'Số điện thoại không đúng định dạng',
               'billing_date.numeric' => 'Thời gian giao hàng bị lỗi'
           ]);
           if($validate->fails()) {
               return redirect()->back()->withInput()->with('messages',$this->getMessageErros($validate->errors()));
           }

       }



       $number_record = count($params['id']);
       $params['products'] = [];
       for ($i = 0; $i < $number_record; $i++) {
           $obj['id'] = $params['id'][$i];
           $obj['quantity'] = $params['quantity'][$i];
           $params['products'][] = $obj;
       }
       $params['products'] = \GuzzleHttp\json_encode($params['products']);




       unset($params['id'],$params['quantity']);

       $result = $this->crmApi->getDataFromApi('/order/create',$params);

       if (!empty($result['data'])) {
            return redirect(route('crm.index'))->with('success',1);
       } else {
           return redirect()->back()->with('messages',$result['message']);
       }



   }

    /**
     * @param Request $request
     * @return array|mixed|null
     */
   public function createCustomer(Request $request)
   {
       $params = $request->all();

       $cookie = Cookie::get('user');
       $cookie = \GuzzleHttp\json_decode($cookie,true);

       $params['headers'] = [
           'Authorization' => $cookie['Authentication'],
           'AppKey' => $cookie['AppKey']
       ];

       $response = $this->crmApi->getDataFromApi('/customer/create',$params);

       return $response;

   }



    /**
     * Get message errors
     * @param $errors
     * @return string
     */
    public function getMessageErros($errors){
        $result = array();
        if(!empty($errors)){
            foreach ($errors->getMessages() as $key=>$value){
                $result[] = $value[0];
            }
        }
        return implode(';',$result);
    }
}

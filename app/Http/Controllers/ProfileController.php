<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Libraries\CrmAPI;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    protected $crmApi;

    public function __construct()
    {
        $this->crmApi = new CrmAPI();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function profile() {

        $params['headers'] = $this->getCookieUser();

        $profile = $this->crmApi->getDataFromApi('/member/detail',$params);

        if (!empty($profile['data'])) {
            $profile = $profile['data'];
            return view('user.profile',compact('profile'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * @param Request $request
     * @return $this|array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|null
     */
    public function listOrder(Request $request)
    {

        $params = $request->all();
        $params['headers'] = $this->getCookieUser();
        if (!empty($params['from'])) {
            $params['from'] = strtotime($params['from']);
        }
        if (!empty($params['to'])) {
            $params['to'] = strtotime($params['to']." 23:59:59");
        }

        //Page and Page size
        $params['page'] = !empty($params['page'])?$params['page']:1;
        $params['page_size'] = 9;

        if (!empty($params['headers'])) {
            $orders = $this->crmApi->getDataFromApi('/order/list',$params);

            $record = $this->crmApi->getDataFromApi('/order/number/list',$params);

            $quantityRecord = $record['data']['quantity'];

            $orders['current_page'] = $params['page'];
            $orders['max_page'] = (int)ceil($quantityRecord/$params['page_size']);
            $orders['pagination'] = $this->htmlPagination($orders);
            $orders['first_time'] = !empty($params['from'])?$params['from']:$record['data']['first_time'];

            if (empty($orders['data'])) {
                return redirect()->back()->withErrors([!empty($orders['message'])?$orders['message']:"Không có đơn hàng nào"]);
            } else {
                return view('user.listOrder',compact('orders','params'));
            }

        } else {
            return view('login');
        }
    }

    

    /**
     * @param $order_id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailOrder($order_id)
    {
        $params['order_id'] = $order_id;
        $params['headers'] = $this->getCookieUser();

        $order_detail = $this->crmApi->getDataFromApi('/order/detail',$params);

        if (!empty($order_detail['data'])) {
           $order_detail = $order_detail['data'];

            return view('user.orderDetail',compact('order_detail'));
        } else {
            return redirect()->back()->withErrors([$order_detail['message']]);
        }

    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listStaff(Request $request)
    {
        $params = $request->all();
        $params['headers'] = $this->getCookieUser();

        //Page and Page size
        $params['page'] = !empty($params['page'])?$params['page']:1;
        $params['page_size'] = 8;


        if (!empty($params['headers'])) {
            $staffs = $this->crmApi->getDataFromApi('/member/groupList',$params);
            $quantityRecord = $this->crmApi->getDataFromApi('/member/quantity/groupList',$params);
            $quantityRecord = $quantityRecord['data'];

            $staffs['current_page'] = $params['page'];
            $staffs['max_page'] = (int)ceil($quantityRecord/$params['page_size']);
            $staffs['pagination'] = $this->htmlPagination($staffs);

            if (empty($staffs['data'])) {
                return redirect()->back()->withErrors([!empty($staffs['message'])?$staffs['message']:"Không có đơn hàng nào"]);
            } else {
                return view('user.listStaff',compact('staffs','params'));
            }

        } else {
            return view('login');
        }
    }

    /**
     * @param $staff_id
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function detailStaff($staff_id)
    {
        $params['id'] = $staff_id;
        $params['headers'] = $this->getCookieUser();

        if (!empty($params['headers'])) {
            $staffs = $this->crmApi->getDataFromApi('/member/groupList',$params);
            if (empty($staffs['data'])) {
                return redirect(route('listStaff'))->withErrors(["Bạn không có quyền xem thông tin promoter yêu cầu"]);
            } else {
                $staff = $staffs['data'][0];
                return view('user.staffDetail',compact('staff'));
            }

        } else {
            return view('login');
        }
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function changePassword(Request $request)
    {
        $params = $request->all();
        $validate = Validator::make($params,[
            'password' => 'required|min:6',
            'new_password' => 'required|min:6'
        ]);

        if ($validate->fails()) {
            $message = $validate->errors();
            return redirect()->back()->withInput()->withErrors([$message->first()]);
        }


        $params['headers'] = $this->getCookieUser();

        $respond = $this->crmApi->getDataFromApi('/member/changepass',$params);

        if (!empty($respond['data'])) {
            $respond['data']['message'] = $respond['message'];
            return $respond['data'];
        } else {;
            $respond['data']['message'] = $respond['message'];
            return $respond['data'];
        }

    }

    /**
     * @return array
     */
    public function getCookieUser()
    {

        $cookie = Cookie::get('user');
        $cookie = \GuzzleHttp\json_decode($cookie,true);

        if (!empty($cookie['Authentication'])) {
            return  [
                'Authorization' => $cookie['Authentication'],
                'AppKey' => $cookie['AppKey']
            ];
        }

        return [];
    }

    /**
     * @param $data
     * @return string
     */
    public function htmlPagination($data)
    {
        $html = "";
        $current_page = $data['current_page'];
        $max_page = $data['max_page'];

        $count_loop = 0;
        $i = -2;

        while ($count_loop < 5) {
            $page_present = $current_page + $i;
            if ($page_present < 1 ) {
                $i = 0;
                if ($current_page == 1) {
                    $html .= '<li class="page-item active"><a class="page-link" id="current" >1</a></li>';
                } else if ($current_page == 2) {
                    $count_loop++;
                    $html .= '<li class="page-item"><a class="page-link"  value="1"  type="submit" onclick="return changePage(this)">1</a></li><li class="page-item active"><a href="" class="page-link" id="current" type="a">2</a></li>';
                }
            } else if ($page_present > $max_page) {
                $page_present_2 = $current_page - 3;
                if ($page_present_2 > 0) {
                    $html = '<li class="page-item"><a href="" class="page-link"  value="'.$page_present_2.'" type="submit" onclick="return changePage(this)">'.$page_present_2.'</a></li>'.$html;
                }
                $count_loop++;
                if ($count_loop >= 5) {
                    break;
                } else {
                    $page_present_2 = $current_page - 4;
                    if ($page_present_2 > 0) {
                        $html = '<li class="page-item"><a href="" class="page-link"  value="'.$page_present_2.'" type="submit" onclick="return changePage(this)">'.$page_present_2.'</a></li>'.$html;
                    }
                }

            } else {
                $html .= ($i === 0) ? '<li class="page-item active"><a href="" class="page-link" id="current" type="a">'.$current_page.'</a></li>' : '<li class="page-item"><a href="" class="page-link" type="submit"  value="'.$page_present.'" onclick="return changePage(this)">'.$page_present.'</a></li>';
            }

            $i++;
            $count_loop++;

        }
        return $html;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function notification(Request $request)
    {
        $params = $request->all();
        $params['headers'] = $this->getCookieUser();
        if (!empty($params['headers'])) {
            $notifications = $this->crmApi->getDataFromApi('/notifications/list',$params);

            //Pagination
            $quantityRecord = $this->crmApi->getDataFromApi('/notifications/quantity',$params);
            $quantityRecord = $quantityRecord['data'];

            $notifications['current_page'] = !empty($params['page'])?$params['page']:1;
            $notifications['max_page'] = (int)ceil($quantityRecord/10);
            $notifications['pagination'] = $this->htmlPagination($notifications);

            return view('user.notification',compact('notifications'));


        } else {
            return view('login');
        }
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|null
     */
    public function readNotification(Request $request)
    {
        $params = $request->all();
        $params['headers'] = $this->getCookieUser();
        if (!empty($params['headers'])) {
            $notifications = $this->crmApi->getDataFromApi('/notifications/read',$params);

            //quantity Record
            $notifications = $notifications['data'];
            return $notifications;
        } else {
            return view('login');
        }
    }

}

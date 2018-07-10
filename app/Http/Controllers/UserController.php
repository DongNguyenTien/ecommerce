<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\CrmAPI;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    protected $crmApi;

    public function __construct()
    {
        $this->crmApi = new CrmAPI();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loginView()
    {
        return view('user.login');
    }

    /**
     * @param Request $request
     * @param string $phone
     * @param string $password
     * @return $this
     */
    public function login(Request $request,$phone = "",$password= "")
    {
        $params = $request->all();
        $flag = 0;

        if (!empty($params['password']) && !empty($params['phone'])) {
            $flag = 1;
        } else if (!empty($phone) && !empty($password)) {
            $flag = 1;
        }

        //Login
        if ($flag == 1) {
            $result = $this->crmApi->getDataFromApi('/member/login',[
                'grant_type' => 'password',
                'client_id' => 'crmapp',
                'client_secret' => '4b9bbd8ccb35e1f7bd6da757cacf7154',
                'phone' => !empty($params['phone'])?$params['phone']:$phone,
                'password' => !empty($params['password'])?$params['password']:$password,
                'device_token' => 'fT5cvlPYNoWYfWcGvqwBedAj2KO2sLBrJXNLdORtM8ejvyjHPky'
            ]);

            if (!empty($result['data'])) {
                //Save to cookie
                $cookie = [
                    'Authentication' => 'WiproCrmApp '.$result['data']['access_token'],
                    'AppKey' => sha1($result['data']['appKey']),
                    'info' => $result['data']['info'],
                    'stock' => $result['data']['stock'],
                ];

                $cookie = \GuzzleHttp\json_encode($cookie);
                if (!empty($params['rememberme'])) {
                    return redirect(route('crm.index'))->withCookie(cookie('user',$cookie));
                } else {
                    return redirect(route('crm.index'))->withCookie(cookie('user',$cookie,60));
                }


            } else {
                return redirect()->back()->withInput()->withErrors([$result['message']]);
            }

        }


    }

    /**
     * @return $this
     */
    public function logout()
    {
        return redirect(route('login'))->withCookie(cookie('user',null));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function lostPassword()
    {
        return view('user.lostPassword');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function sendOtp(Request $request)
    {

        $phone = $request->phone;
        if (empty($phone)) {
            return redirect()->back()->withErrors(['Không được để trống số điện thoại']);
        }

        $result = $this->crmApi->getDataFromApi('/member/forgot',[
            'phone' => $phone,
        ]);

        $md5 = $result['message'];
        if (strlen($md5) == 32 && ctype_xdigit($md5)) {
            session()->put('md5',$md5);
            session()->put('phone',$phone);
            return redirect(route('otpView'));
        } else {
            return redirect()->back()->withErrors(['Số điện thoại không tồn tại']);
        }

        return view('user.otp');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function otpView()
    {
        $md5 = session('md5');
        $phone = session('phone');
        if (!empty($md5) && !empty($phone)) {
            return view('user.otp');
        } else {
            return redirect(route('crm.index'));
        }
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmOtp(Request $request)
    {
        $md5 = session('md5');
        $phone = session('phone');
        $otp = $request->otp;

        if ($md5 == md5($phone.'@'.$otp)) {
            session()->put('otp',$otp);
            session()->put('success-otp',1);
            return redirect(route('changePasswordView'));
        } else {
            return redirect()->back()->withErrors(['Mã otp sai']);
        }
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function changePasswordView()
    {
        if (session('success-otp') == 1) {
            return view('user.changePassword');
        } else {
            return redirect(route('crm.index'));
        }
    }

    /**
     * @param Request $request
     * @return $this
     */
    public function changePassword(Request $request)
    {
        if (session('success-otp') == 1) {
            $params = $request->all();
            $validate = Validator::make($params,[
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required|min:6'
            ]);

            if ($validate->fails()) {
                $message = $validate->errors();
                return redirect()->back()->withInput()->withErrors([$message->first()]);
            }

            $result = $this->crmApi->getDataFromApi('/member/otp',[
                'phone' => session('phone'),
                'otp' => session('otp'),
                'new_password' => $params['password']
            ]);
            //If change password successfully => Login

            if ($result['data']['success'] == 1) {
                $phone = session('phone');
                //Delete session
                session()->forget('phone');
                session()->forget('otp');
                session()->forget('md5');
                session()->forget('success-otp');

                return $this->login(new Request(),$phone,$params['password']);




            } else {
                return redirect()->back()->withInput()->withErrors(["Đổi mật khẩu thất bại"]);
            }


        } else {
            return redirect(route('crm.index'));
        }

    }
}

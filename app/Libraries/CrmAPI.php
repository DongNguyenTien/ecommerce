<?php

namespace App\Libraries;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class CrmAPI
{
    protected $url;
    protected $version;

    public function __construct()
    {
        $this->url = env('CRM_API_URL');
        $this->version = env('CRM_API_VERSION');

    }

    protected function getApi($uri, $params = [], $method = '', $headers)
    {
        try {
            $client = new Client();

            $url = $this->url.'/api/'.$this->version.$uri;


            switch ($method) {
                case 'post':

                    $res = $client->post($url, [
                        'multipart'=>$params,
                        'headers' => $headers
                        ]);

                    break;
                case 'get':
                    $res = $client->get($url, array('form_params' => $params));
                    break;
            }

            if (isset($res)) {
                return $res;
            } else {
                return false;
            }
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return false;
        }
    }


    protected function getApiData($uri, $param = array(),$headers = [])
    {
        try {
            $method='post';
            $res = $this->getApi($uri, $param, $method, $headers);



            if ($res) {
                $items = $res->getBody()->getContents();
                $items = \GuzzleHttp\json_decode($items,true);

                $result = $items;

                return $result;

            }
            else return null;
        } catch (\Exception $ex) {
            Log::error($ex->getMessage());

            return array();
        }
    }


    public function getDataFromApi($uri,$params = [])
    {
        //Solve params
        $multipart = [];

        foreach ($params as $key=>$value) {
            if ($key == "avatar") {
                $multipart[] = [
                    'name' => $key,
                    'contents' => fopen($value->getRealPath(),'rb'),
                    'filename' => $value->getClientOriginalName(),
//                    'headers' => !empty($params['headers'])?$params['headers']:[],
                ];
            } else if ($key == 'headers') {
                continue;
            } else {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value,
//                    'headers' => !empty($params['headers'])?$params['headers']:[],
                ];
            }

        }

        $headers = !empty($params['headers'])?$params['headers']:[];


        $result= $this->getApiData($uri,$multipart,$headers);

        if(!empty($result)){
            return $result;
        }
        else return [];
    }




}

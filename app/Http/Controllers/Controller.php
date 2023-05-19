<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    /**
     * Create customer inquiry page on storeFront
     *
     * @return mixed
     */
    public function createAssets($activeTheme_id)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        if( $activeTheme_id ):
            $inquiryCSS = view('liquid.pip_css')->render();
            $cssData = array('asset' => array('key' => 'assets/pip.css', 'value' => $inquiryCSS));
            $shop->api()->rest('PUT', '/admin/themes/' . $activeTheme_id . '/assets.json', $cssData);
        endif;
    }

    /**
     * Delete guest inquiry pages on storeFront
     *
     * @return void
     */
    public function deleteAssets($previousTheme_id)
    {
        $shop = Auth::user();
        $domain = $shop->getDomain()->toNative();
        if( $previousTheme_id ):
            // start login section deleting
            $assetDeleted = $shop->api()->rest('DELETE', '/admin/themes/' . $previousTheme_id . '/assets.json', array('asset' => array('key' => 'assets/pip.css')));
            info(json_encode($assetDeleted));
        endif;
    }

    public function rest_api($api_endpoint, $query = array(), $method = 'GET')
    {
        $url = "https://" . $this->shop_url . $api_endpoint;

        if (in_array($method, array('GET', 'DELETE')) && !is_null($query)) {

            $url = $url . '?' . http_build_query($query);
        }
        $crul = curl_init($url);
        curl_setopt($crul, CURLOPT_HEADER, true);
        curl_setopt($crul, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($crul, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($crul, CURLOPT_MAXREDIRS, 3);
        curl_setopt($crul, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($crul, CURLOPT_TIMEOUT, 30);
        curl_setopt($crul, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($crul, CURLOPT_CUSTOMREQUEST, $method);
        $headers[] = "";
        if (!is_null($this->access_token)) {
            $headers[] = "X-Shopify-Access-Token:" . $this->access_token;
            curl_setopt($crul, CURLOPT_HTTPHEADER, $headers);
        }
        if ($method != 'GET' && in_array($method, array('POST', 'PUT'))) {
            if (is_array($query))
                $query = http_build_query($query);
            curl_setopt($crul, CURLOPT_POSTFIELDS, $query);
        }
        $response = curl_exec($crul);
        $error = curl_errno($crul);
        $error_msg = curl_error($crul);
        curl_close($crul);
        if ($error) {
            return $error_msg;
        } else {
            //respone format and split into 2 subarrays
            $response = preg_split("/\r\n\r\n|\n\n|\r\r/", $response, 2);
            // echo print_r($response);
            $headers = array();
            $headers_content = explode("/n", $response[0]);
            $headers['status'] = $headers_content[0];
            array_shift($headers_content);
            foreach ($headers_content as $content) {
                $data = explode(':', $content);
                $headers[trim($data[0])] = trim($data[1]);
            }
            //    echo print_r($headers);
            //    echo print_r($response[1]);
            return array('headers' => $headers, 'body' => $response[1]);
        }
    }
}

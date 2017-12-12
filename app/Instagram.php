<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;


class instagram extends Model
{
   private $apiCallback = 'http://statman.dev/code';

   private $apioauthurl = 'https://api.instagram.com/oauth/authorize';
   private $apioauthtokenurl = 'https://api.instagram.com/oauth/access_token';

   public function new(){
      $this['apiCallback'] = 'http://statman.dev/code';
      $this['apioauthurl'] = 'https://api.instagram.com/oauth/authorize';
      $this['apioauthtokenurl'] = 'https://api.instagram.com/oauth/access_token';
   }

   public function getLoginUrl() {
      // dd($this);
      return $this->apioauthurl . '?client_id=' . env('INSTA_CLIENT_ID') . '&redirect_uri=' . urlencode($this->apiCallback) . '&response_type=code';
   }

   public function getOAuthToken($code, $token = false)
    {
        $apiData = array(
            'code' => $code
        );
        $result = $this->_makeOAuthCall($apiData);
        return !$token ? $result : $result->access_token;
    }

    private function _makeOAuthCall($apiData)
    {
      // $apiHost = $this['apioauthtokenurl'];
        $apiHost = $this['apioauthtokenurl'];
        $response = Curl::to($apiHost)
          ->withData( array( 'client_id' => env('INSTA_CLIENT_ID'),
                             'client_secret' => env('INSTA_CLIENT_SECRET'),
                             'grant_type' => 'authorization_code',
                             'redirect_uri' => $this->getApiCallback(),
                             'code' => $apiData['code']) )
          ->returnResponseObject()
          ->post();



          return view('welcome')->with('data', $response->content);
    }
}

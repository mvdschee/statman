<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Crypt;


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
        $apiHost = $this['apioauthtokenurl'];
        $response = Curl::to($apiHost)
          ->withData( array( 'client_id' => env('INSTA_CLIENT_ID'),
                             'client_secret' => env('INSTA_CLIENT_SECRET'),
                             'grant_type' => 'authorization_code',
                             'redirect_uri' => 'http://statman.dev/code',
                             'code' => $apiData['code']) )
          ->returnResponseObject()
          ->post();


          $response = json_decode($response->content);
          if(property_exists($response, 'access_token')){
             return $response;
          } else {
             $errors = $response;
             return $errors;
          }

    }

    public function newprofile($data){
      $error = '';
      if(property_exists($data, 'access_token')){
         $continue = true;
         $profiles = Instagram::all();
         $instagram = new Instagram;
         $instagram->profile = $data->user->full_name;
         $instagram->token = encrypt($data->access_token);
         $instagram->profileid = $data->user->id;
         foreach($profiles as $profile){
            if($profile->profileid == $data->user->id){
               $error = "This profile has already been bound. ";
               $continue = false;
            }
         }
         if($continue == true){
            $instagram->save();
            return "Succesfully made a connection with Instagram.";
         } else {
            return $error;
         }
      } else {
         $error = "There was an error receiving a token for your account";
         return $error;
      }
   }


   // MAKE THIS FUNCTION IN JAVASCRIPT
   public function getPosts($profile){
      //get access_token from database
      $token = decrypt($profile->token);
      //Get user_id from database
      $userid = $profile->profileid;
      //define url for request
      $apiHost = 'https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$token;
      //execute request
      $response = Curl::to($apiHost)
        ->returnResponseObject()
        ->get();

     //json to object
     $response = json_decode($response->content);
     //return data
     return $response;

   }
}

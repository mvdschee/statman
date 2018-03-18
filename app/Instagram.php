<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Crypt;
use App\Service;



class instagram extends Model
{

   public function new(){
      $this['apiCallback'] = env('APP_URL').'/code';
      $this['apioauthurl'] = 'https://api.instagram.com/oauth/authorize';
      $this['apioauthtokenurl'] = 'https://api.instagram.com/oauth/access_token';
   }

   public function getLoginUrl() {
      return $this->apioauthurl . '?client_id=' . env('INSTA_CLIENT_ID') . '&redirect_uri=' . urlencode($this->apiCallback) .'&response_type=code';
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
                             'redirect_uri' => env('APP_URL') . '/code',
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
         $profiles = Service::where('project_id', $data->project_id)->where('service_index', 1)->get();
         $instagram = new Service;
         $instagram->service_index = 1;
         $instagram->service_page_name = encrypt($data->user->full_name);
         $instagram->service_token = encrypt($data->access_token);
         $instagram->service_id = encrypt($data->user->id);
         $instagram->project_id = $data->project_id;


         foreach($profiles as $profile){
            if($profile->service_id !== 0){
               if(decrypt($profile->service_id) == $data->user->id){
                  $error = "This profile has already been bound to this project";
                  $continue = false;
               }
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


   public function getPosts($project){
      $service = Service::where('project_id', $project)->where('service_index', 1)->first();

      //get access_token from database
      $token = decrypt($service->service_token);
      //Get user_id from database
      $userid = decrypt($service->service_id);
      //define url for request
      $apiHost = 'https://api.instagram.com/v1/users/'.$userid.'/media/recent/?access_token='.$token;
      //execute request
      $response = Curl::to($apiHost)
        // ->returnResponseObject()
        ->get();

     //json to object
     $response = json_decode($response);
     //return data
     return $response;

   }
}

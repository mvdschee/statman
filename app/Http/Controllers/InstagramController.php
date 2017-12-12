<?php

namespace App\Http\Controllers;

use App\Instagram;
use Illuminate\Http\Request;

class InstagramController extends Controller
{

   public function index()
   {
     //
     $instagram = new Instagram;
     $instagram->new();
     $login = $instagram->getLoginUrl();
     if(!isset($userdata) || $isset($_GET['code'])){
         return redirect($login);
     } else {
         dd($_GET['code']);
         return view('dashboards/instagram');
     }
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function home(){
      $profiles = Instagram::all();
      $code = $_SERVER['REQUEST_URI'] . '&';
      $array = explode('&', $code);
      $i = 0;
      foreach($array as $string) {
          $string = explode('=', $string);
          $array[$i] = $string;
          $i++;
      }
      $tokenredirect = '/token/'.$array[0][1];
      return redirect($tokenredirect);
      // return view('dashboards/instagram')->with('string', $array[0][1])->with('profiles', $profiles);
    }

   public function token($code){
     $profiles = Instagram::all();
     $instagram = new Instagram;
     $instagram->new();
     $token = $instagram->getOAuthToken($code);
     $data = $instagram->newprofile($token);
     return view('dashboards/instagram')->withData($data)->with('profiles', $profiles);

  }

  public function error($code){
     return view('dashboards/error')->withData('data', 'token not found')->with('profiles', $profiles);
  }

  public function posts(){
     $data = '';
     $posts = '';
     $profiles = Instagram::all();
     $i = 0;
     foreach($profiles as $profile){
        $posts[$i] = $profile->getPosts($profile);
        $i++;
     }
     return view('dashboards/instaposts')->with('posts', $posts);
 }
}

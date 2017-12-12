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
      $code = $_SERVER['REQUEST_URI'] . '&';
      $array = explode('&', $code);
      // dd($array);
      $i = 0;
      foreach($array as $string) {
          $string = explode('=', $string);
          $array[$i] = $string;
          $i++;
      }

      // dd($array);
      // $string = explode('=', $code);
      return view('dashboards/instagram')->with('string', $array[0][1]);
    }

   public function token($code){
     $instagram = new Instagram;
     $instagram->new();
     $token = $instagram->getOAuthToken($code);
     return $token;
  }
}

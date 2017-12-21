<?php

namespace App\Http\Controllers;

use App\Instagram;
use Illuminate\Http\Request;

class InstagramController extends Controller
{

   public function index($project)
   {
     $instagram = new Instagram;
     $instagram->new();
     $login = $instagram->getLoginUrl();
     if(!isset($userdata) || $isset($_GET['code'])){
        session(['project' => $project]);
         return redirect($login);
     } else {
        return redirect(env('APP_URL' . '/story-list'));
     }
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function home(Request $request){
      //get token from url
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
    }

   public function token($code, Request $request){
     $instagram = new Instagram;
     $instagram->new();
     $token = $instagram->getOAuthToken($code);
     $session = $request->session()->all();
     $token->project_id = $session['project'];
     $session['project'] = '';
     $data = $instagram->newprofile($token);
     return redirect(env('APP_URL') . '/story-list')->withErrors(['Instagram succesfully connected.']);

  }

  public function getPosts(){
     $profiles = Instagram::all();
     $i = 0;
     foreach($profiles as $profile){
        $posts[$i] = $profile->getPosts($profile);
        $i++;
     }
     return $posts;
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
     return $posts;
     return view('dashboards/instaposts')->with('posts', '');
 }
}

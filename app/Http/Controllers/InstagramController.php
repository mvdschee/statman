<?php

namespace App\Http\Controllers;

use App\Instagram;
use Illuminate\Http\Request;
use App\Service;
use Illuminate\Support\Facades\Crypt;
use Auth;
use App\UserAccess;

class InstagramController extends Controller
{

   public function index($project)
   {
     //
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
     $message = "successfully connected to Instagram!";
     return redirect('/story-list')->with('check', $message);

  }

  public function getPosts($project_id){
      $user = Auth::id();
      $access = UserAccess::where([
              ['project_id', '=', $project_id],
              ['user_id', '=', $user]
          ])->first();

      if ($access == null) {
          return "invalid project id supplied.";
      } else {
         $services = Service::where('project_id', $project_id)->where('service_index', 1)->get();
         $i = 0;
         $posts = '';
         if($services){
           foreach($services as $service){
              $service = new Instagram;
              $posts[$i] = $service->getPosts($project_id);
              $i++;
           }
           return $posts;
         } else {
           return false;
         }
      }
   }
}

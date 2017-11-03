<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;

class VerifyController extends Controller
{
 	public function index($error = null)
   {
      $user = Auth::user();
      print($user['verificationkey'] . '</br>');
      if(!empty($error)){
         return view('verify', ['errorauth' => $error]);

      } else {
         return view('verify');
      }
      // print(strtotime($user['expiretime']));
   }

   public function verify(Request $request)
   {
      $messages = '';
      //gets all user data
      $request_data = $request->All();
      $user = Auth::user();
      // defines expiretime as timestamp
      $expiretime = strtotime($user['expiretime']);

      // gets date
      $datecurrent = date("Y-m-d h:i:s");
      // defines date as timestamp
      $datecurrent = strtotime($datecurrent);
      if($expiretime >= $datecurrent){

         if($request_data['token'] == $user['verificationkey']){
            $user->verified = true;
            $user->save();
            return redirect('/story-list');
         } else {
            $messages = $messages . ' this code is not valid, would you like a new one?';
            return Redirect::action('VerifyController@index')->withErrors($messages);
         }

      } else {
         $user->verificationkey = mt_rand(100000, 999999);

         $expiretimedate = date("Y-m-d h:i:s");
         $expiretime = strtotime($expiretimedate);
         $expiretime = $expiretime + 86400;
         $user->expiretime = date("Y-m-d H;i;s", $expiretime);
         $user->save();
         $messages = $messages . ' this code has expired, would you like a new one?';
         return Redirect::action('VerifyController@index')->withErrors($messages);
      }
   }
}

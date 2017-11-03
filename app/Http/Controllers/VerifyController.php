<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Validator;
use Redirect;

class VerifyController extends Controller
{
 	public function index($error = null)
   {
      $user = Auth::user();
      print($user->verificationkey . '</br>');
      print($user->verifycount . '</br>');
      if(!empty($error)){
         return view('verify', ['errorauth' => $error]);

      } else {
         return view('verify');
      }
      // print(strtotime($user['expiretime']));
   }



   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
   // protected function validator(Request $request)
   // {
   //    $request_data = $request->All();
   //    return Validator::make($request, [
   //         'token' => 'required|min:5|max:6',
   //    ]);
   // }

   public function verify(Request $request)
   {

   $this->validate($request, [
        'token' => 'required|min:6|max:6',
    ]);


      $messages = '';
      //gets all user data
      $request_data = $request->All();
      $user = Auth::user();
      // defines expiretime as timestamp
      $expiretime = strtotime($user->updated_at) + 43200;

      // gets date
      $datecurrent = date("Y-m-d h:i:s");
      // defines date as timestamp
      $datecurrent = strtotime($datecurrent);


      if($user->verifycount < 6) {

         if($datecurrent <= $expiretime){

            if($request_data['token'] == $user['verificationkey']){

               $user->verified = true;
               $user->save();
               return redirect('/story-list');

            } else {

               $messages = 'This token is not correct.';
               $user->verifycount = $user->verifycount + 1;
               $user->save();
               return Redirect::action('VerifyController@index')->withErrors($messages);
            }
         } else {
            $messages = 'This token has expired';
            return view('verify', ['expire' => true])->withErrors($messages);
         }
      } else {
         $messages = 'You fucked up fam.';
         $user->verificationkey = 0;
         $user->save();
         return Redirect::action('VerifyController@index')->withErrors($messages);
      }
   }

   public function NewToken()
   {
      $messages = '';
      $user = Auth::user();
      if($user->verifycount <= 6 || $user->verificationkey !== 0) {
         $user->verificationkey = mt_rand(100000, 999999);
         $user->verifycount = 0;
         $user->save();
         $messages = 'A new token has been sent to you.';
         return redirect('verify')->withErrors($messages);
      } else {
         $messages = 'You fucked up fam.';
         $user->verificationkey = 0;
         $user->save();
         return Redirect::action('VerifyController@index')->withErrors($messages);
      }
   }
}

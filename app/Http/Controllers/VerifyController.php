<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Mail;
use Session;
use Illuminate\Support\Facades\Validator;
use Redirect;

class VerifyController extends Controller
{

// display view to verify

 	public function index($error = null)
   {
      $user = Auth::user();
      if(!empty($error)){
         return view('dashboards.verify', ['errorauth' => $error]);

      } else {
         return view('dashboards.verify');
      }
   }



   /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    **/


// Verification function
   public function verify(Request $request)
   {

   // Check if given input CAN be valid
   $this->validate($request, [
        'token' => 'required|min:6|max:6',
    ]);

   //  Get error messages
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

   // Check if user is still allowed to verify
   if($user->verifycount < 6) {

      // Check if token from database is still valid
      if($datecurrent <= $expiretime){

         // Check if given input is the same as the token
         if($request_data['token'] == $user['verificationkey']){

            // verify the user
            $user->verified = true;
            $user->save();
            return redirect('/story-list');

         } else {
            // don't verify the user, add attempt to the count of attempts
            $messages = 'This token is not correct.';
            $user->verifycount = $user->verifycount + 1;
            $user->save();
            return Redirect::action('VerifyController@index')->withErrors($messages);
         }
      } else {
         // The token has expired, new token can be requested
         $messages = 'This token has expired';
         return view('dashboards.verify', ['expire' => true])->withErrors($messages);
      }
   } else {
      // This user is blocked from attempting to verify, giving errormessage and setting the token to 0 to block any attempt of verifying the account
      $messages = 'You have attempted to verify your account too many times without success.';
      $user->verificationkey = 0;
      $user->save();
      return Redirect::action('VerifyController@index')->withErrors($messages);
   }
   }

// Request new token
   public function NewToken()
   {
      // Get messages
      $messages = '';

      // Get user data
      $user = Auth::user();

      // Check if the user is allowed to request a new token
      if($user->verifycount <= 6 || $user->verificationkey !== 0) {
         // generate random token
         $verificationkey = mt_rand(100000, 999999);

         // get email from session
         $SessionMail = Session::get( 'email' );
         // set token to verify
         $user->verificationkey = $verificationkey;
         // reset attempt counter
         $user->verifycount = 0;
         $user->save();

         // get user email and set up a message
         $user->SessionMail = $SessionMail;
         $messages = 'A new token has been sent to you.';

         // send email
         Mail::send('emails.token', ['user' => $user, 'token' => $verificationkey], function ($m) use ($user) {
               $m->from(env('MAIL_FROM'), env('MAIL_NAME'));
               $m->to($user->SessionMail, $user->firstname)->subject('You have requested a new verification token.');
         });

         // redirect to verification page
         return redirect('dashboards.verify')->withErrors($messages);
      } else {
         $messages = 'Your account cannot request a new token.';
         $user->verificationkey = 0;
         $user->save();

         // redirect to verification page
         return Redirect::action('VerifyController@index')->withErrors($messages);
      }
   }
}

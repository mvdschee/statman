<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Session;
use Validator;
use App\User;
use App\Project;
use App\UserAccess;
use App\InviteToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SettingsController extends Controller
{
    // gets information to show in settings
    public function index(){
        // Get email from login user
        $SessionMail = Session::get( 'email' );

        // Get info from login user
        $user = Auth::user();
		$Name = decrypt( $user->name );

		return view( 'settings', compact( 'SessionMail', 'Name'));
	}

    // validator for information that is changed
    public function credential_validator(array $data){

        if ($data['fullname']) {
            $rules = [
                'fullname' => 'required'
            ];
        }
        elseif($data['current_password'] || $data['password'] || $data['password_confirmation']){
            $rules = [
                'current_password' => 'required',
                'password' => 'required|same:password',
                'password_confirmation' => 'required|same:password'
            ];
        }
        else{
            return false;
        }

        $validator = Validator::make($data, $rules);
        return $validator;
    }

    // request gets filterd to validate only for filled form
    public function updateProfile(Request $request){
        $request_data = $request->All();
        $current_password = $request_data['current_password'];
        $password = $request_data['password'];
        $password_confirmation = $request_data['password_confirmation'];
        $fullname = $request_data['fullname'];

        if($fullname){
            $this->updateName($fullname);
            $fullnameMessage = 'Profile updated!';
        }
        else{
            $message = 'Nothing to update!';
            $this->Notifier($message);
        }

        if($current_password || $password || $password_confirmation){
            $this->updatePassword($current_password, $password, $password_confirmation);
        }
        else{
            $message = 'Nothing to update!';
            $message = $fullnameMessage;
            $this->Notifier($message);
        }
        return $this->Notifier($message);
    }

    public function updateName(string $request_data){

        $array = ['fullname' => $request_data];

        $validator = $this->credential_validator($array);

        if($validator->fails()){
            $message = 'Name is incorrect!';
            $this->Notifier($message);
        }
        else{
            $user = Auth::user();
            $user->name = encrypt($request_data);
            $user->save();

            $message = 'Profile updated!';
            $this->Notifier($message);
        }
    }

    public function updatePassword(string $current_password, $password, $password_confirmation){
        $array = [
            'current_password' => $current_password,
            'password' => $password,
            'password_confirmation' => $password_confirmation,
            'fullname' => ''];

        $validator = $this->credential_validator($array);

        if($validator->fails()){
            $message = 'New password did not match!';
            $this->Notifier($message);
        }
        else{
            $old_password = Auth::User()->password;
            if(Hash::check($current_password, $old_password)){
                $user = Auth::user();
                $user->password = Hash::make($password);;
                $user->save();

                $message = 'Profile updated!';
                $this->Notifier($message);
            }
            else{
                $message = 'Please enter correct current password!';
                $this->Notifier($message);
            }
        }
    }

    // get message to output succes of action and redirect.
    public function Notifier(string $message){
        return redirect('/settings')->with('status', $message);
    }
}

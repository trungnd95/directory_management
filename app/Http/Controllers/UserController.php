<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Validator;
use App\Http\Requests;
use App\User;
use Request;
use Hash,Mail;
use Illuminate\Support\Facades\Input;
use Alert; 

class UserController extends Controller
{
    /**
    *   List all administrator of site
    * @param
    */
    public function index() 
    {
        $admins = User::all();
    	return view('templates.Administrators.index')->with('admins',$admins);
    }

    /**
    *   Add new administrator
    *   @param
    */
    public function add()
    {
        if(Request::ajax())    
        {
            $data = Request::all();
            $validate = Validator::make($data,[
                'username'  => 'required|min:5|max:20',
                'email'     => 'required|email',
                'level'     => 'required'
            ],[
                'username.required' => 'Username is required',
                'username.min'      => 'User name is at least 5 characters',
                'username.max'      => 'User name is too long',
                'email.required'    => 'Email is required',
                'email.email'       => 'Email is not true',    
                'level.requied'     => 'You was not choose level' 
            ]);

            if($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }

            $username = Request::get('username');
            $email = Request::get('email');
            $level = Request::get('level');
            $password = str_random(8);
            $token = Request::get('_token');
            $confirmation_code = str_random(10);
            $data = array('password'=> $password,'confirmation_code' => $confirmation_code);
            User::create([
                "username" => $username,
                'email'    => $email,
                'password' => Hash::make($password),
                'confirmation_code' => $confirmation_code,
                'level'    => $level,
            ]);
            Mail::send('auth.emails.verify',$data,function($message) {
                $message->to(Request::get('email'),Request::get('username'))->subject('Verify your email address');
            });
            $id_user = User::select('id')->orderBy('id','DESC')->take(1)->first();
            
            $response = array('id'=> $id_user->id , 'username'=> $username, 'email'=>$email, 'level'=>$level);
            return json_encode($response);

            
        }
    }

    /**
    *   Delete a administrator 
    *   @param
    **/

    public function destroy()
    {

        if(Request::ajax()) {
            $id = Request::get('id');
            $admin = User::findOrFail($id);
            $admin->delete();
            return $id;
        }
    }


    /**
    *   Get view to edit administration 
    *   @param : id : id of this administrator
    */
    public function edit($id)
    {
        $admin = User::find($id);
        return view('templates.Administrators.edit',compact('admin'));
    }

    /**
    *   Function save new data just edited to database
    *   @param
    **/
    public function update($id)
    {
        $validator =  Validator::make(Request::all(),[
            'username' => 'required|min:5|max:20',
            'email'    => 'required|email',
            'password' => 'required|min:5'
        ],[
            'username.required' => 'Username is required',
            'username.min'      => 'Username is at least 5 characters',
            'username.max'      => 'Username is less than 20 characters',
            'email.requied'     => 'Email is required',
            // 'email.unique'      => 'Email was exist',
            'password.required' => 'Password is required ',
            'password.min'      => 'Password is at least 5 characters'
        ]);

        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }

        $admin = User::findOrFail($id);
        $confirmation_code = str_random(10);
        if(Request::file('avatar'))
        {
            $avatar = Request::file('avatar')->getClientOriginalName();
            //Upload image
            $des =  base_path().'/public/upload/images/users/';
            if(isset($avatar)) 
            {
                Request::file('avatar')->move($des,$avatar);
            }    
        }else 
        {
            $avatar = $admin->avatar;
        }
        
        
        $admin->update([
            'username'  => Request::get('username'),
            'email'     => Request::get('email'),
            'password'  => Hash::make(Request::get('password')),
            'confirmation_code' => $confirmation_code,
            'avatar'   => $avatar,

        ]);
        return redirect()->route('administration.index')-> with(['flash_level' => 'success', 'flash_message'=> 'Edit Success']);
    }

    /**
    *   Get view to confirmation and change password
    *   @param: token: to definite a admin 
    **/
    public function getConfirm($confirmation_code)
    {
        if( ! $confirmation_code)
        {
            throw new InvalidConfirmationCodeException;
        }

        $new_ad = User::where('confirmation_code',$confirmation_code)->first();
        $new_ad->confirmed =  1;
        $new_ad->save();
        return view('templates.Administrators.confirmation')->with(['flash_level'=>'success','flash_message'=> 'Account actived! Please change password you desire!','new_ad'=>$new_ad]);
    }

    /**
    *   Store new password
    *   @param: confirmation_code to definite administrator
    **/
    public function postConfirm($confirmation_code)
    {
        
        $validator = Validator::make(Request::all(),[
            'password'      => 'required|confirmed|min:5'
        ],[
            'password.requied'       => 'New password id required field',
            'password.confirmed'     => 'New password is not confirmed',
            'password.min'           => 'Password is at least 5 characters'
        ]);
        if($validator->fails()) {
            return back()->withInput()->withErrors($validator);
        }
        $user = User::where('confirmation_code',$confirmation_code)->first();
        // Validate the new password length...
        $user->password = Hash::make(Request::get('password'));
        $user->confirmation_code  = null;
        $user->save();
        // dd(Hash::make(Request::get(password)));
        return redirect('/logout')->with(['flash_level'=>'success','flash_message'=>'Your profile updated']);
    }

    //Change password 
    /**
     * [viewChangePassword description]
     * @return [type] [description]
     */
    public function viewChangePassword($id)
    {
        return view('templates.Administrators.changePassword');
    }

    /**
     * [postChangePassword description]
     * @return [type] [description]
     */
    public function postChangePassword($id)
    {
        $user = User::findOrFail($id);
        $new_password = Request::get('new_password');
        $user->password = Hash::make($new_password);
        $user->save();
        Alert::success('Password changed !!!')->persistent('Close');
        return redirect()->route('administration.index');
    }

    /**
     * [checkOldPassword description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function checkOldPassword($id)
    {
        if(Request::ajax())
        {
            $id = Request::get('id');
            // dd(Request::get('val'));
            $val = Request::get('val');
            $user = User::findOrFail($id);
            
            if(Hash::check($val, $user->password))
            {
                return response()->json('ok');
            }else {
                return response()->json('Mật khẩu cũ không đúng');
            }
        }
    }

}

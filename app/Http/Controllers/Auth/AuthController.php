<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Auth;
use Alert;
use Hash; 

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Handle a login request to the application.
     * This function to rewrite core 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
                'email'     => 'required|email',
                'password'  => 'required',
        ],[
                'email.required'    => "Email field is required",
                'email.email'       =>  "Email have to follow standard",
                'password.required' => "Email field is required",
        ]);

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $remember = false;
        if(isset($request->remember) && $request->remember == 1) $remember = true;
        $login = array(
                'email'     => $request->email,
                'password'  => $request->password,
                'confirmed' => 1
         );
        $user =  User::where('email','=',$request->email)->first();
        if(count($user) > 0){
            if(Hash::check($request->password, $user->password))
            {
                if($user->confirmed == 1)
                {
                    if(Auth::attempt($login, $remember))
                    {
                        Alert::success("Login success !!!")->persistent("Close");
                        return redirect()->route('departments.index');            
                    }
                }
                else {
                    // Alert::error("Information access denied")->persistent("Close");
                    return redirect()->back()->withErrors(['Please visit your email to see confimration account instruction !!']);
                }
            }else
            {
                    return redirect()->back()->withErrors(['Ooops !!! Information access denied !!']);          
            }
        }
            
         // if(Auth::attempt($login, $remember)) {
         //    Alert::success("Login success !!!")->persistent("Close");
         //    return redirect()->route('departments.index');
         // } else {
         //    Alert::error("Information access denied")->persistent("Close");
         //    return redirect()->back()->withErrors(['Information access denied!']);
         // }
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Contracts\Validation\Validator;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(Request $data): array
    {
        return Validator::make($data->all(), [
            'prefixname' => ['required', 'string', 'max:255'],
            'firstname' => ['required', 'string', 'max:255'],
            'middlename' => ['string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'suffixname' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'file' => ['required|mimes:png|max:2048',]
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function register(Request $data)
    {

        $data->validate([
            'prefixname' => ['max:255'],
            'firstname' => ['required', 'max:255'],
            'middlename' => ['max:255'],
            'lastname' => ['required', 'max:255'],
            'suffixname' => ['max:255'],
            'username' => ['required', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['min:8'],
            'file' => ['mimes:png']

        ]); 

        //Move Uploaded File
        $file = $data->file('file');
        // return var_dump($file);
        if ($file != null) {
            $destinationPath = 'uploads';
            $file->move($destinationPath,$file->getClientOriginalName());
        }

        User::create([
             'prefixname' => in_array($data['prefixname'], ['Mr', 'Mrs', 'Ms']) ? $data['prefixname'] : null,
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'suffixname' => $data['suffixname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'photo' => $file != null ? $data->file->getClientOriginalName() : ''
        ]);

        return redirect('/login')->with('success', 'Account created successfully! Login.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {

        $users = $user->getAllUsers();
        return view('users.index',['users' => $users]);   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // return Auth::user()->id;

        $data = $user->getSingleUser(Auth::user()->id);
        $fname = $user->middleinitial;
        $avatar = $user->avatar;

        // return $id;
        return view('users.show', ['user' => $data, 'fullname' => $fname, 'avatar' => $avatar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return $id;
        $data = User::find($id);
        $avatar = $data->avatar;
        return view('users.edit', ['user' => $data, 'avatar' => $avatar]);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $data, $id)
    {
        // return $id;
         $data->validate([
            'prefixname' => ['max:255'],
            'firstname' => ['required', 'max:255'],
            'middlename' => ['max:255'],
            'lastname' => ['required', 'max:255'],
            'suffixname' => ['max:255'],
            'username' => ['required', 'max:255', 'unique:users,username,' . $id],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $id],
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

        // return '34';
        
        $user = User::find($id);
        $user->update([
             'prefixname' => in_array($data['prefixname'], ['Mr', 'Mrs', 'Ms']) ? $data['prefixname'] : $user->prefixname,
            'firstname' => $data['firstname'],
            'middlename' => $data['middlename'],
            'lastname' => $data['lastname'],
            'suffixname' => $data['suffixname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
            'photo' => $file != null ? $data->file->getClientOriginalName() : $user->photo
        ]);

        return back()->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return $id;
        $data = User::find($id)->delete();

        return redirect()->back()->with('message', 'User deleted successfully!');
  
    }


     /**
     * Display a listing of the resource -- soft deleted users.
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed(User $user)
    {

       $users = $user->getTrashedUsers();
        return view('users.trashed',['users' => $users]); 

    }

    /**
     * Restore the soft deleted record.
     *
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {

        $users = User::restoreTrashedUsers($id);
        return redirect('/users')->with('message', 'User restored successfully!');
        return view('users.trashed',['users' => $users]); 

    }

    /**
     * Permanently delete a soft deleted user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function forcedelete($id)
    {
        $data = User::forceDeleteUser($id);

        return redirect('/users')->with('message', 'User permanently deleted successfully!');
  
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Perm;
use Validator;

class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
        //testing aja
    }

    function index()
    {
    	$user = User::find(\Auth::user()->id);

    	if (empty($user)) {
            flash('Profile not found')->error();
            return redirect('dashboard/profiles');
        }

        $perm = Perm::pluck('name', 'id');

    	return view('dashboard.setting.profile')->with('user',$user)->with('perm',$perm);
    }

    function edit()
    {
        $user = User::find(\Auth::user()->id);

        if (empty($user)) {
            flash('Profile not found')->error();
            return redirect('dashboard/profiles');
        }

        $perm = Perm::pluck('name', 'id');

        return view('dashboard.setting.edit-profile')->with('user',$user)->with('perm',$perm);
    }

    function password()
    {
        $user = User::find(\Auth::user()->id);

        if (empty($user)) {
            flash('Profile not found')->error();
            return redirect('dashboard/profiles');
        }

    	return view('dashboard.setting.edit-password')->with('user', $user);	
    }

    function p_password(Request $request)
    {
    	$rules_prf = array(
            'current_password' 	=> 'required|old_password:'.\Auth::user()->password,
            'new_password'		=> 'required|different:current_password',
            'verify_new_password'=> 'required|same:new_password'
        );

        $message = array(
        	'current_password.old_password' => 'Old Password not valid'
        );
                
        $validate = Validator::make($request->all(), $rules_prf,$message);
                
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }

        $user = User::find(\Auth::user()->id);
        flash('Congratulation! Password has been changed successfully')->success();
		$user->password = \Hash::make($request->new_password);
		$user->save();

        return redirect('dashboard/profiles');
    }

    function p_edit(Request $request)
    {
        $photo = $request->photo;
    	$rules_prf = array(
            'name'   	=> 'required',
            'email'		=> 'required|email',
            'profile'   => 'max:5000'
        );        
                
        $validate = Validator::make($request->all(), $rules_prf);
                
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }

        if ($request->hasFile('profile')) {
            $image = $request->file('profile');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/profile');
            $image->move($destinationPath, $name);
            $photo = $name;                
        }
        
        $user = User::find(\Auth::user()->id);
        flash('Congratulation! '.$user->name.' has been updated successfully')->success();
		$user->name = $request->name;
		//$user->email = $request->email;		
        //$user->image = $photo;
		$user->save();	

        return redirect('dashboard/profiles');
    }
}

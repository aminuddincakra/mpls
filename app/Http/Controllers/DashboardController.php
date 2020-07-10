<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use Validator;

class DashboardController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(\Auth::user()->perm_id == 1){
            return view('dashboard.home.index');
        }else{
            return view('dashboard.home.siswa');
        }
    }

    public function profile()
    {
        return view('dashboard.home.profile');
    }

    public function home()
    {
        return view('dashboard.home.home');
    }

    public function jadwal()
    {
        return view('dashboard.home.jadwal');
    }

    public function jurnal()
    {
        return view('dashboard.home.jurnal');
    }

    public function kejadian()
    {
        return view('dashboard.home.kejadian');
    }

    public function post()
    {
        return view('dashboard.home.post');
    }

    public function materi($id=null)
    {
        if($id == ''){
            abort(404);
        }

        $post = Post::findOrFail($id);
        if(empty($post)){
            abort(404);   
        }

        return view('dashboard.home.materi')->with('post',$post);
    }
}

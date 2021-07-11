<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Post;
use App\Models\Pengumuman;
use App\Models\Materi;
use App\Models\Activity;
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
            $pengumuman = Pengumuman::where('status', 1)->orderBy('id', 'ASC')->first();
            $materi = Materi::whereDate('date', \Carbon\Carbon::now()->format('Y-m-d'))->first();
            $data = [];
            if($materi){
                $jur = \Auth::user()->jurusan_id;
                $data = Post::where('materi_id', $materi->id)->where(function($query) use($jur){
                    return $query->whereNull('jurusan_id')->orWhere('jurusan_id', $jur);
                })->get();                
            }

            $mbuh = (is_array($data)) ? $data : $data->toArray();
            $materi = array_column($mbuh, 'id');
            if(array_key_exists(0, $materi)){
                Activity::firstOrCreate(['user_id' => \Auth::user()->id, 'post_id' => $materi['0']]);
            }

            return view('dashboard.home.home')->with('pengumuman', $pengumuman)->with('materi', $materi)->with('data', $data);
        }
    }

    public function profile()
    {
        return view('dashboard.home.profile');
    }

    public function home()
    {
        $pengumuman = Pengumuman::where('status', 1)->orderBy('id', 'ASC')->first();
        $materi = Materi::whereDate('date', \Carbon\Carbon::now()->format('Y-m-d'))->first();

        return view('dashboard.home.home')->with('pengumuman', $pengumuman)->with('materi', $materi);
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

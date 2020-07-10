<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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

    public function post()
    {
        return view('dashboard.home.post');
    }

    public function cari(Request $request)
    {
        if($request->kode_kelas != ''){
            return redirect('dashboard/cari-kelas/'.$request->kode_kelas);
        }
    }

    public function get_kelas($id='')
    {
        if($id == ''){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard');
        }

        $kelas = Kelas::where('kode', $id)->first();

        if(empty($kelas)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard');
        }

        return view('dashboard.kelas.cari')->with('kelas',$kelas)->with('id',$id);
    }

    public function store_kelas($id, Request $request)
    {
        $rules_prf = array(
            'token'      => 'required',
        );        
                
        $validate = Validator::make($request->all(), $rules_prf);
                
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return back()->withInput()->withErrors($validate);
        }

        $kelas = Kelas::where('kode', $id)->first();
        if($kelas->token != $request->token){
            flash('Kode Token Salah','warning');
            return redirect('dashboard/cari-kelas/'.$id);
        }

        $kelas = new Pkelas;
        $kelas->user_id = \Auth::user()->id;
        $kelas->kelas_id = $kelas->kelas_id;
        $kelas->save();

        flash('Selamat Subscribe kelas berhasil','success');
        return redirect('dashboard');
    }

    public function subs($id='')
    {
        if($id == ''){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard');
        }

        $kelas = new Pkelas;
        $kelas->user_id = \Auth::user()->id;
        $kelas->kelas_id = $id;
        $kelas->save();

        flash('Selamat Subscribe kelas berhasil','success');
        return redirect('dashboard');
    }

    public function sekolah()
    {
        $user = \Auth::user();
        $sekolah = \Auth::user()->identitas;
        $status = array('Negeri', 'Swasta');

        return view('dashboard.setting.sekolah')->with('user',$user)->with('sekolah',$sekolah)->with('status',$status);
    }

    public function save_sekolah(Request $request)
    {
        $profile = $request->profiles;

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/profile');
            $image->move($destinationPath, $name);
            $profile = $name;
        }

        Identitas::updateOrCreate(
            ['user_id' => \Auth::user()->id],
            ['name' => $request->name, 'alamat' => $request->alamat, 'telephone' => $request->telephone, 'kepsek' => $request->kepsek, 'nipkepsek' => $request->nipkepsek, 'profile' => $profile, 'npsn' => $request->npsn, 'status' => ($request->status) ? $request->status : 0]
        );

        flash('Identitas sekolah '.$request->name.' berhasil diperbaharui','success');
        return redirect('dashboard/sekolah');
    }

    public function update_profile(Request $request)
    {
        $tanggal = new \DateTime($request->tanggal_lahir);

        User::where('id', \Auth::user()->id)->update([
            'name'          => $request->name,
            'alamat'        => $request->alamat,
            'jk'            => $request->jk,
            'tempat_lahir'  => $request->tempat_lahir,
            'tgl_lahir'     => $tanggal->format('Y-m-d')
        ]);

        flash('Data profile berhasil diupdate','success');
        return redirect('dashboard');   
    }
}

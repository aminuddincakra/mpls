<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Jurusan;
use Response;
use Validator;
use Excel;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }

    public function index()
    {
    	$siswa = User::where('perm_id', 2)->orderBy('jurusan_id','ASC')->paginate(20);
    	$kelas = User::where('perm_id', 2)->pluck('aktifkan', 'kelas');    	

    	return view('dashboard.siswa.index')->with('siswa',$siswa)->with('kelas',$kelas);
    }

    public function import(Request $request)
    {
    	$rules_prf = array(
            'file'      => 'required'
        );        
                
        $validate = Validator::make($request->all(), $rules_prf);
                
        if ($validate->fails()) {                
            $messages = $validate->messages();
            return redirect('dashboard/ujians/'.$request->ujian_id.'#import')->withInput()->withErrors($validate);
        }

        $upload = '';

        if($request->hasFile('file')){
            $image = $request->file('file');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/sample');
            $image->move($destinationPath, $name);
            $upload = $name;
        }
        
        Excel::load(public_path('sample/'.$upload), function($reader) use($request) {
            $reader->noHeading();
            $results = $reader->all();
            $jur = null;
            $kls = null;
            foreach($results as $key => $row){
                if($key > 0){
                    $jur = Jurusan::firstOrCreate(['name' => $row['4']]);                    
                    if($row['0'] != '' AND $row['1'] != '' AND $row['2'] != '' AND $row['3'] != '' AND $row['4'] != '' AND $row['5'] != '' AND $row['6'] != ''){
                        User::insert(['name' => trim($row['2']), 'email' => trim($row['1']), 'password' => \Hash::make(trim($row['1'])), 'kelas' => trim($row['3']), 'jurusan_id' => $jur->id, 'perm_id' => 2, 'activate' => 1, 'wali_kelas' => trim($row['5']), 'link' => trim($row['6'])]);
                    }  
                }
            }
        });
        unlink(public_path('sample/'.$upload));

        flash('Selamat, import soal berhasil','success');
        return redirect('dashboard/siswa#import');
    }

    public function kelas(Request $request)
    {
    	foreach($request->aktifkan as $key => $dt){
    		$dxx = new \DateTime($dt);
    		User::where('kelas', $key)->update(['aktifkan' => $dxx->format('Y-m-d')]);
    	}

    	flash('Selamat, update kelas berhasil','success');
        return redirect('dashboard/siswa#kelas');
    }
}

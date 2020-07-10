<?php

namespace App\Http\Controllers;

use App\Models\Perm;
use Illuminate\Http\Request;
use Response;
use Validator;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $perm = Perm::orderBy('id','DESC')->get();

        return view('dashboard.role.index')->with('perm',$perm);
    }

    public function search(Request $request)
    {
        if($request->search != ''){
            return redirect('dashboard/roles?search='.$request->search);
        }elseif(is_array($request->items) AND count($request->items) > 0){
            Ujian::whereIn('id', $request->items)->delete();
            return redirect('dashboard/roles');
        }else{
            flash('Tidak ada data role yang dicheck','info');
            return redirect('dashboard/roles');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perm = new Perm;
        $perm->name = $request->name;
        $perm->permission = @serialize($request->permission);
        $perm->save();

        flash('Selamat, '.$request->name.' berhasil disimpan','success');
        return redirect('dashboard/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perm = Perm::findOrFail($id);

        if(empty($perm)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/roles');
        }

        return view('dashboard.role.edit')->with('perm',$perm);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $perm = Perm::findOrFail($id);

        if(empty($perm)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/roles');
        }

        $perm->name = $request->name;
        $perm->permission = @serialize($request->permission);
        $perm->save();

        flash('Selamat, '.$request->name.' berhasil diupdate','success');
        return redirect('dashboard/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perm = Perm::findOrFail($id);

        if(empty($perm)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/roles');
        }

        flash('Selamat, '.$perm->name.' berhasil dihapus','success');
        $perm->delete();
        return redirect('dashboard/roles');
    }
}

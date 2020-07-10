<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
    public function index(Request $request)
    {
        $kueri = User::whereNotNull('password');
        if($request->get('search') != ''){
            $kueri->where('name', 'like', '%'.$request->get('search').'%')->orWhere('email', 'like', '%'.$request->get('search').'%');
        }
        $user = $kueri->paginate(10);
        $search = $request->get('search');

        return view('dashboard.user.index')->with('user',$user)->with('search',$search);       
    }

    public function search(Request $request)
    {
        if($request->search != ''){
            return redirect('dashboard/users?search='.$request->search);
        }elseif(is_array($request->items) AND count($request->items) > 0){
            User::whereIn('id', $request->items)->delete();
            return redirect('dashboard/users');
        }else{
            flash('Tidak ada data user yang dicheck','info');
            return redirect('dashboard/users');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (empty($user)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/users');
        }

        flash('Selamat, '.$user->name.' berhasil dihapus','success');
        $user->delete();
        return redirect('dashboard/users');
    }

    public function status(Request $request)
    {
        User::where('id', $request->id)
            ->update(['activate' => $request->status]);
    }
}

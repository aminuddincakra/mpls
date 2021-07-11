<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\CreateMateriAPIRequest;
use App\Http\Requests\API\UpdateMateriAPIRequest;
use App\Models\Materi;
use App\Models\Jurusan;
use App\Models\Post;
use App\Models\Activity;
use App\Repositories\MateriRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class MateriController
 * @package App\Http\Controllers\API
 */

class MateriController extends AppBaseController
{
    /** @var  MateriRepository */
    private $materiRepository;

    public function __construct(MateriRepository $materiRepo)
    {
        $this->middleware('auth');   
        $this->materiRepository = $materiRepo;
    }

    /**
     * Display a listing of the Materi.
     * GET|HEAD /materis
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->materiRepository->pushCriteria(new RequestCriteria($request));
        $this->materiRepository->pushCriteria(new LimitOffsetCriteria($request));
        $materis = $this->materiRepository->orderBy('id', 'DESC')->all();

        return view('dashboard.materi.index')->with('materis',$materis);
    }

    public function create()
    {
        return view('dashboard.materi.create');
    }

    public function create_detail($id)
    {
        $data[] = 'Semua Jurusan';
        $jurusan = Jurusan::pluck('name', 'id')->toArray();
        foreach($jurusan as $key => $dt){
            $data[$key] = $dt;
        }

        return view('dashboard.materi.create_detail')->with('jurusan', $data)->with('id', $id);   
    }

    public function report()
    {
        return view('dashboard.materi.report');
    }

    public function post_report(Request $request)
    {
        dd($request->jenis);
    }

    /**
     * Store a newly created Materi in storage.
     * POST /materis
     *
     * @param CreateMateriAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMateriAPIRequest $request)
    {
        $input = $request->all();

        $input['date'] = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $materis = $this->materiRepository->create($input);

        flash('Selamat, '.$request->title.' berhasil disimpan','success');
        return redirect('dashboard/materis');
    }

    public function post_detail($id, Request $request)
    {
        $input = $request->all();

        $name = null;
        if($request->has('file')){
            $size = $request->file('file')->getSize();            
            $image = $request->file('file');
            $names = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/');
            $image->move($destinationPath, $names);
            $name = $names;            
        }

        $input['status'] = ($request->status) ? 1 : 0;
        $input['pinned'] = ($request->pinned) ? 1 : 0;
        $input['jurusan_id'] = ($request->jurusan_id) ? $request->jurusan_id : null;
        $input['name'] = $request->name;
        $input['text'] = $request->text;
        $input['embed'] = $request->embed;
        $input['materi_id'] = $id;
        $input['file'] = $name;
        Post::create($input);

        flash('Selamat, '.$request->name.' berhasil disimpan','success');
        return redirect('dashboard/materis/'.$id);
    }

    public function edit($id)
    {
        /** @var Materi $materi */
        $materi = $this->materiRepository->findWithoutFail($id);

        if (empty($materi)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis');
        }

        return view('dashboard.materi.edit')->with('materi',$materi);
    }

    public function edit_detail($id, $ids)
    {
        $post = Post::findOrFail($id);

        if (empty($post)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis/'.$ids);
        }

        $data[] = 'Semua Jurusan';
        $jurusan = Jurusan::pluck('name', 'id')->toArray();
        foreach($jurusan as $key => $dt){
            $data[$key] = $dt;
        }        

        return view('dashboard.materi.edit_detail')->with('post',$post)->with('jurusan', $data)->with('ids', $ids);
    }

    /**
     * Display the specified Materi.
     * GET|HEAD /materis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Materi $materi */
        $materi = $this->materiRepository->findWithoutFail($id);

        if (empty($materi)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis');
        }

        $post = $materi->posts;

        return view('dashboard.materi.show')->with('materi',$materi)->with('post', $post);
    }

    /**
     * Update the specified Materi in storage.
     * PUT/PATCH /materis/{id}
     *
     * @param  int $id
     * @param UpdateMateriAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMateriAPIRequest $request)
    {
        $input = $request->all();

        /** @var Materi $materi */
        $materi = $this->materiRepository->findWithoutFail($id);

        if (empty($materi)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis');
        }

        $input['date'] = \Carbon\Carbon::parse($request->date)->format('Y-m-d');
        $materi = $this->materiRepository->update($input, $id);

        flash('Selamat, '.$request->title.' berhasil diupdate','success');
        return redirect('dashboard/materis');
    }

    public function update_detail($id, $ids, Request $request)
    {
        $input = $request->all();

        $post = Post::findOrFail($id);

        if(empty($post)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis/'.$ids);
        }

        $name = $post->file;
        if($request->has('file')){
            $size = $request->file('file')->getSize();            
            $image = $request->file('file');
            $names = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/');
            $image->move($destinationPath, $names);
            $name = $names;            
        }

        $post->status = ($request->status) ? 1 : 0;
        $post->pinned = ($request->pinned) ? 1 : 0;
        $post->jurusan_id = ($request->jurusan_id) ? $request->jurusan_id : null;
        $post->name = $request->name;
        $post->text = $request->text;
        $post->embed = $request->embed;
        $post->file = $name;
        $post->save();        

        flash('Selamat, '.$request->name.' berhasil disimpan','success');
        return redirect('dashboard/materis/'.$ids);
    }

    public function store_activity(Request $request)
    {
        Activity::firstOrCreate(['user_id' => $request->user, 'post_id' => $request->materi]);
    }

    public function review($id)
    {
        $materi = Materi::findOrFail($id);

        if(empty($materi)){
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis/'.$id);
        }

        $post = $materi->posts;

        return view('dashboard.materi.review')->with('materi',$materi)->with('post', $post);
    }

    /**
     * Remove the specified Materi from storage.
     * DELETE /materis/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Materi $materi */
        $materi = $this->materiRepository->findWithoutFail($id);

        if (empty($materi)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis');
        }

        flash('Selamat, '.$materi->title.' berhasil dihapus','success');
        $materi->delete();
        return redirect('dashboard/materis');        
    }

    public function destroy_detail($id, $ids)
    {
        $post = Post::findOrFail($id);

        if (empty($post)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/materis/'.$ids);
        }

        flash('Selamat, '.$post->title.' berhasil dihapus','success');
        $post->delete();
        return redirect('dashboard/materis/'.$ids);
    }
}

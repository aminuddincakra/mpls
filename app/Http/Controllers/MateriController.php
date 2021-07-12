<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\CreateMateriAPIRequest;
use App\Http\Requests\API\UpdateMateriAPIRequest;
use App\User;
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

use Excel;
use App\Exports\AbsenMultipleExport;
use App\Exports\ActivityMultipleExport;

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
        $data = [];
        $now = \Carbon\Carbon::parse($request->tanggal)->format('Y-m-d');
        if($request->jenis == 'hadir'){
            $name = "absen_harian_".time().".xlsx";
            $uploadDest = '/sample/' . $name;

            $absen = User::where('perm_id', 2)->whereHas('logs', function($query) use($now){
                return $query->whereDate('created_at', $now);
            })->get();

            $abs = array_column($absen->toArray(), 'id');

            $no_absen = User::where('perm_id', 2)->whereNotIn('id', $abs)->get();

            $data = array(
                'Masuk'         => $absen,
                'Tidak Masuk'   => $no_absen
            );

            $uploadedFile = Excel::store(new AbsenMultipleExport($data, $request), $uploadDest, 'public_uploads');            
            return response()->download(public_path('uploads/'.$uploadDest));
        }else{
            $data = [];
            $name = "rekap_keaktifan_".time().".xlsx";
            $uploadDest = '/sample/' . $name;

            $materi = Materi::whereDate('date', $now)->first();

            if(!$materi){
                flash('Tidak ada materi MPLS untuk hari ini','warning');
                return redirect('dashboard/report');
            }

            $post = $materi->posts->pluck('id', 'name');            
            $id_all = array_values($post->toArray());

            $last_col = self::column_excel(count($post) + 3);            
            $user = User::where('perm_id', 2)->get();
            foreach($user as $dt){
                $data[] = array(
                    'id'        => $dt->id,
                    'name'      => $dt->name,
                    'kelas'     => $dt->kelas,
                    'activity'  => $dt->activitiesFilter($id_all)->pluck('created_at', 'post_id')->toArray()
                );
            }
            
            $uploadedFile = Excel::store(new ActivityMultipleExport($data, $post, $last_col, $request), $uploadDest, 'public_uploads');
            return response()->download(public_path('uploads/'.$uploadDest));
        }
    }

    private static function column_excel($val)
    {
        $char = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

        $preff = '';
        $bagi = doubleval(doubleval($val) / 26);
        $col = ($val % 26 == 0) ? $val : $val % 26;
        if($bagi > 1){
            if(array_key_exists(intval($bagi)-1, $char)){
                $preff = $char[intval($bagi)-1];
            }
        }
        
        return $preff.$char[$col-1];
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\CreatePengumumanAPIRequest;
use App\Http\Requests\API\UpdatePengumumanAPIRequest;
use App\Models\Pengumuman;
use App\Repositories\PengumumanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PengumumanController
 * @package App\Http\Controllers\API
 */

class PengumumanController extends AppBaseController
{
    /** @var  PengumumanRepository */
    private $pengumumanRepository;

    public function __construct(PengumumanRepository $pengumumanRepo)
    {
        $this->middleware('auth');   
        $this->pengumumanRepository = $pengumumanRepo;
    }

    /**
     * Display a listing of the Pengumuman.
     * GET|HEAD /pengumumen
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->pengumumanRepository->pushCriteria(new RequestCriteria($request));
        $this->pengumumanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $pengumumen = $this->pengumumanRepository->all();

        return view('dashboard.pengumuman.index')->with('pengumumen',$pengumumen);
    }

    public function create()
    {
        return view('dashboard.pengumuman.create');
    }

    /**
     * Store a newly created Pengumuman in storage.
     * POST /pengumumen
     *
     * @param CreatePengumumanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePengumumanAPIRequest $request)
    {
        $input = $request->all();

        $input['status'] = ($request->status) ? 1 : 0;
        $pengumumen = $this->pengumumanRepository->create($input);

        flash('Selamat, '.$request->title.' berhasil disimpan','success');
        return redirect('dashboard/pengumumans');
    }

    /**
     * Display the specified Pengumuman.
     * GET|HEAD /pengumumen/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Pengumuman $pengumuman */
        $pengumuman = $this->pengumumanRepository->findWithoutFail($id);

        if (empty($pengumuman)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/pengumumans');
        }

        return view('dashboard.pengumuman.edit')->with('pengumuman',$pengumuman);
    }

    /**
     * Update the specified Pengumuman in storage.
     * PUT/PATCH /pengumumen/{id}
     *
     * @param  int $id
     * @param UpdatePengumumanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePengumumanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Pengumuman $pengumuman */
        $input['status'] = ($request->status) ? 1 : 0;
        $pengumuman = $this->pengumumanRepository->findWithoutFail($id);

        if (empty($pengumuman)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/pengumumans');
        }

        $pengumuman = $this->pengumumanRepository->update($input, $id);

        flash('Selamat, '.$request->title.' berhasil diupdate','success');
        return redirect('dashboard/pengumumans');
    }

    /**
     * Remove the specified Pengumuman from storage.
     * DELETE /pengumumen/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Pengumuman $pengumuman */
        $pengumuman = $this->pengumumanRepository->findWithoutFail($id);

        if (empty($pengumuman)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/pengumumans');
        }

        flash('Selamat, '.$pengumuman->title.' berhasil dihapus','success');
        $pengumuman->delete();
        return redirect('dashboard/pengumumans');
    }
}

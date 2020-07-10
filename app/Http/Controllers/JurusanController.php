<?php

namespace App\Http\Controllers;

use App\Http\Requests\API\CreateJurusanAPIRequest;
use App\Http\Requests\API\UpdateJurusanAPIRequest;
use App\Models\Jurusan;
use App\Repositories\JurusanRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class JurusanController
 * @package App\Http\Controllers\API
 */

class JurusanController extends AppBaseController
{
    /** @var  JurusanRepository */
    private $jurusanRepository;

    public function __construct(JurusanRepository $jurusanRepo)
    {
        $this->middleware('auth');     
        $this->jurusanRepository = $jurusanRepo;
    }

    /**
     * Display a listing of the Jurusan.
     * GET|HEAD /jurusans
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->jurusanRepository->pushCriteria(new RequestCriteria($request));
        $this->jurusanRepository->pushCriteria(new LimitOffsetCriteria($request));
        $jurusans = $this->jurusanRepository->orderBy('id', 'DESC')->all();

        return view('dashboard.jurusan.index')->with('jurusans',$jurusans);
    }

    public function create()
    {
        return view('dashboard.jurusan.create');
    }

    /**
     * Store a newly created Jurusan in storage.
     * POST /jurusans
     *
     * @param CreateJurusanAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateJurusanAPIRequest $request)
    {
        $input = $request->all();

        $jurusans = $this->jurusanRepository->create($input);

        flash('Selamat, '.$request->name.' berhasil disimpan','success');
        return redirect('dashboard/jurusans');
    }

    public function edit($id)
    {
        /** @var Jurusan $jurusan */
        $jurusan = $this->jurusanRepository->findWithoutFail($id);

        if (empty($jurusan)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/jurusans');
        }

        return view('dashboard.jurusan.edit')->with('jurusan',$jurusan);
    }

    /**
     * Display the specified Jurusan.
     * GET|HEAD /jurusans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Jurusan $jurusan */
        $jurusan = $this->jurusanRepository->findWithoutFail($id);

        if (empty($jurusan)) {
            return $this->sendError('Jurusan not found');
        }

        return $this->sendResponse($jurusan->toArray(), 'Jurusan retrieved successfully');
    }

    /**
     * Update the specified Jurusan in storage.
     * PUT/PATCH /jurusans/{id}
     *
     * @param  int $id
     * @param UpdateJurusanAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJurusanAPIRequest $request)
    {
        $input = $request->all();

        /** @var Jurusan $jurusan */
        $jurusan = $this->jurusanRepository->findWithoutFail($id);

        if (empty($jurusan)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/jurusans');
        }

        $jurusan = $this->jurusanRepository->update($input, $id);

        flash('Selamat, '.$request->name.' berhasil diupdate','success');
        return redirect('dashboard/jurusans');
    }

    /**
     * Remove the specified Jurusan from storage.
     * DELETE /jurusans/{id}
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Jurusan $jurusan */
        $jurusan = $this->jurusanRepository->findWithoutFail($id);

        if (empty($jurusan)) {
            flash('Halaman tidak ditemukan','warning');
            return redirect('dashboard/jurusans');
        }

        flash('Selamat, '.$jurusan->name.' berhasil dihapus','success');
        $jurusan->delete();
        return redirect('dashboard/jurusans');        
    }
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMateriAPIRequest;
use App\Http\Requests\API\UpdateMateriAPIRequest;
use App\Models\Materi;
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

class MateriAPIController extends AppBaseController
{
    /** @var  MateriRepository */
    private $materiRepository;

    public function __construct(MateriRepository $materiRepo)
    {
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
        $materis = $this->materiRepository->all();

        return $this->sendResponse($materis->toArray(), 'Materis retrieved successfully');
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

        $materis = $this->materiRepository->create($input);

        return $this->sendResponse($materis->toArray(), 'Materi saved successfully');
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
            return $this->sendError('Materi not found');
        }

        return $this->sendResponse($materi->toArray(), 'Materi retrieved successfully');
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
            return $this->sendError('Materi not found');
        }

        $materi = $this->materiRepository->update($input, $id);

        return $this->sendResponse($materi->toArray(), 'Materi updated successfully');
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
            return $this->sendError('Materi not found');
        }

        $materi->delete();

        return $this->sendResponse($id, 'Materi deleted successfully');
    }
}

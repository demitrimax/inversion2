<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinvproveedoresRequest;
use App\Http\Requests\UpdateinvproveedoresRequest;
use App\Repositories\invproveedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class invproveedoresController extends AppBaseController
{
    /** @var  invproveedoresRepository */
    private $invproveedoresRepository;

    public function __construct(invproveedoresRepository $invproveedoresRepo)
    {
        $this->invproveedoresRepository = $invproveedoresRepo;
        $this->middleware('permission:invproveedores-list');
        $this->middleware('permission:invproveedores-create', ['only' => ['create','store']]);
        $this->middleware('permission:invproveedores-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:invproveedores-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the invproveedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->invproveedoresRepository->pushCriteria(new RequestCriteria($request));
        $invproveedores = $this->invproveedoresRepository->all();

        return view('invproveedores.index')
            ->with('invproveedores', $invproveedores);
    }

    /**
     * Show the form for creating a new invproveedores.
     *
     * @return Response
     */
    public function create()
    {
        return view('invproveedores.create');
    }

    /**
     * Store a newly created invproveedores in storage.
     *
     * @param CreateinvproveedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateinvproveedoresRequest $request)
    {
        $input = $request->all();

        $invproveedores = $this->invproveedoresRepository->create($input);

        Flash::success('Invproveedores guardado correctamente.');
        Alert::success('Invproveedores guardado correctamente.');

        return redirect(route('invproveedores.index'));
    }

    /**
     * Display the specified invproveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invproveedores = $this->invproveedoresRepository->findWithoutFail($id);

        if (empty($invproveedores)) {
            Flash::error('Invproveedores no encontrado');
            Alert::error('Invproveedores no encontrado.');

            return redirect(route('invproveedores.index'));
        }

        return view('invproveedores.show')->with('invproveedores', $invproveedores);
    }

    /**
     * Show the form for editing the specified invproveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invproveedores = $this->invproveedoresRepository->findWithoutFail($id);

        if (empty($invproveedores)) {
            Flash::error('Invproveedores no encontrado');
            Alert::error('Invproveedores no encontrado');

            return redirect(route('invproveedores.index'));
        }

        return view('invproveedores.edit')->with('invproveedores', $invproveedores);
    }

    /**
     * Update the specified invproveedores in storage.
     *
     * @param  int              $id
     * @param UpdateinvproveedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinvproveedoresRequest $request)
    {
        $invproveedores = $this->invproveedoresRepository->findWithoutFail($id);

        if (empty($invproveedores)) {
            Flash::error('Invproveedores no encontrado');
            Alert::error('Invproveedores no encontrado');

            return redirect(route('invproveedores.index'));
        }

        $invproveedores = $this->invproveedoresRepository->update($request->all(), $id);

        Flash::success('Invproveedores actualizado correctamente.');
        Alert::success('Invproveedores actualizado correctamente.');

        return redirect(route('invproveedores.index'));
    }

    /**
     * Remove the specified invproveedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invproveedores = $this->invproveedoresRepository->findWithoutFail($id);

        if (empty($invproveedores)) {
            Flash::error('Invproveedores no encontrado');
            Alert::error('Invproveedores no encontrado');

            return redirect(route('invproveedores.index'));
        }

        if ($invproveedores->operaciones->count()>0) {
            Flash::error('El proveedor tiene operaciones registradas');
            Alert::error('El proveedor tiene operaciones registradas');

            return back();
        }

        $this->invproveedoresRepository->delete($id);

        Flash::success('Invproveedores borrado correctamente.');
        Flash::success('Invproveedores borrado correctamente.');

        return redirect(route('invproveedores.index'));
    }
}

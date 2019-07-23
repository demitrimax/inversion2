<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproveedoresRequest;
use App\Http\Requests\UpdateproveedoresRequest;
use App\Repositories\proveedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class proveedoresController extends AppBaseController
{
    /** @var  proveedoresRepository */
    private $proveedoresRepository;

    public function __construct(proveedoresRepository $proveedoresRepo)
    {
        $this->proveedoresRepository = $proveedoresRepo;
        $this->middleware('permission:proveedores-list');
        $this->middleware('permission:proveedores-create', ['only' => ['create','store']]);
        $this->middleware('permission:proveedores-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:proveedores-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the proveedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->proveedoresRepository->pushCriteria(new RequestCriteria($request));
        $proveedores = $this->proveedoresRepository->all();

        return view('proveedores.index')
            ->with('proveedores', $proveedores);
    }

    /**
     * Show the form for creating a new proveedores.
     *
     * @return Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created proveedores in storage.
     *
     * @param CreateproveedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateproveedoresRequest $request)
    {
        $input = $request->all();

        $proveedores = $this->proveedoresRepository->create($input);

        Flash::success('Proveedores guardado correctamente.');
        Alert::success('Proveedores guardado correctamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Display the specified proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado.');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.show')->with('proveedores', $proveedores);
    }

    /**
     * Show the form for editing the specified proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.edit')->with('proveedores', $proveedores);
    }

    /**
     * Update the specified proveedores in storage.
     *
     * @param  int              $id
     * @param UpdateproveedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproveedoresRequest $request)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }

        $proveedores = $this->proveedoresRepository->update($request->all(), $id);

        Flash::success('Proveedores actualizado correctamente.');
        Alert::success('Proveedores actualizado correctamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Remove the specified proveedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }

        $this->proveedoresRepository->delete($id);

        Flash::success('Proveedores borrado correctamente.');
        Flash::success('Proveedores borrado correctamente.');

        return redirect(route('proveedores.index'));
    }
}

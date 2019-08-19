<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefacturaraRequest;
use App\Http\Requests\UpdatefacturaraRequest;
use App\Repositories\facturaraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class facturaraController extends AppBaseController
{
    /** @var  facturaraRepository */
    private $facturaraRepository;

    public function __construct(facturaraRepository $facturaraRepo)
    {
        $this->facturaraRepository = $facturaraRepo;
        $this->middleware('permission:facturaras-list');
        $this->middleware('permission:facturaras-create', ['only' => ['create','store']]);
        $this->middleware('permission:facturaras-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:facturaras-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the facturara.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facturaraRepository->pushCriteria(new RequestCriteria($request));
        $facturaras = $this->facturaraRepository->all();

        return view('facturaras.index')
            ->with('facturaras', $facturaras);
    }

    /**
     * Show the form for creating a new facturara.
     *
     * @return Response
     */
    public function create()
    {
        return view('facturaras.create');
    }

    /**
     * Store a newly created facturara in storage.
     *
     * @param CreatefacturaraRequest $request
     *
     * @return Response
     */
    public function store(CreatefacturaraRequest $request)
    {
        $input = $request->all();

        $facturara = $this->facturaraRepository->create($input);

        Flash::success('Facturara guardado correctamente.');
        Alert::success('Facturara guardado correctamente.');

        return redirect(route('facturaras.index'));
    }

    /**
     * Display the specified facturara.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado.');

            return redirect(route('facturaras.index'));
        }

        return view('facturaras.show')->with('facturara', $facturara);
    }

    /**
     * Show the form for editing the specified facturara.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }

        return view('facturaras.edit')->with('facturara', $facturara);
    }

    /**
     * Update the specified facturara in storage.
     *
     * @param  int              $id
     * @param UpdatefacturaraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefacturaraRequest $request)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }

        $facturara = $this->facturaraRepository->update($request->all(), $id);

        Flash::success('Facturara actualizado correctamente.');
        Alert::success('Facturara actualizado correctamente.');

        return redirect(route('facturaras.index'));
    }

    /**
     * Remove the specified facturara from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }

        $this->facturaraRepository->delete($id);

        Flash::success('Facturara borrado correctamente.');
        Flash::success('Facturara borrado correctamente.');

        return redirect(route('facturaras.index'));
    }
}

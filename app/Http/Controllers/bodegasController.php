<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebodegasRequest;
use App\Http\Requests\UpdatebodegasRequest;
use App\Repositories\bodegasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class bodegasController extends AppBaseController
{
    /** @var  bodegasRepository */
    private $bodegasRepository;

    public function __construct(bodegasRepository $bodegasRepo)
    {
        $this->bodegasRepository = $bodegasRepo;
        $this->middleware('permission:bodegas-list');
        $this->middleware('permission:bodegas-create', ['only' => ['create','store']]);
        $this->middleware('permission:bodegas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bodegas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the bodegas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bodegasRepository->pushCriteria(new RequestCriteria($request));
        $bodegas = $this->bodegasRepository->all();

        return view('bodegas.index')
            ->with('bodegas', $bodegas);
    }

    /**
     * Show the form for creating a new bodegas.
     *
     * @return Response
     */
    public function create()
    {
        return view('bodegas.create');
    }

    /**
     * Store a newly created bodegas in storage.
     *
     * @param CreatebodegasRequest $request
     *
     * @return Response
     */
    public function store(CreatebodegasRequest $request)
    {
        $input = $request->all();

        $bodegas = $this->bodegasRepository->create($input);

        Flash::success('Bodegas guardado correctamente.');
        Alert::success('Bodegas guardado correctamente.');

        return redirect(route('bodegas.index'));
    }

    /**
     * Display the specified bodegas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bodegas = $this->bodegasRepository->findWithoutFail($id);

        if (empty($bodegas)) {
            Flash::error('Bodegas no encontrado');
            Alert::error('Bodegas no encontrado.');

            return redirect(route('bodegas.index'));
        }

        return view('bodegas.show')->with('bodegas', $bodegas);
    }

    /**
     * Show the form for editing the specified bodegas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bodegas = $this->bodegasRepository->findWithoutFail($id);

        if (empty($bodegas)) {
            Flash::error('Bodegas no encontrado');
            Alert::error('Bodegas no encontrado');

            return redirect(route('bodegas.index'));
        }

        return view('bodegas.edit')->with('bodegas', $bodegas);
    }

    /**
     * Update the specified bodegas in storage.
     *
     * @param  int              $id
     * @param UpdatebodegasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebodegasRequest $request)
    {
        $bodegas = $this->bodegasRepository->findWithoutFail($id);

        if (empty($bodegas)) {
            Flash::error('Bodegas no encontrado');
            Alert::error('Bodegas no encontrado');

            return redirect(route('bodegas.index'));
        }

        $bodegas = $this->bodegasRepository->update($request->all(), $id);

        Flash::success('Bodegas actualizado correctamente.');
        Alert::success('Bodegas actualizado correctamente.');

        return redirect(route('bodegas.index'));
    }

    /**
     * Remove the specified bodegas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bodegas = $this->bodegasRepository->findWithoutFail($id);

        if (empty($bodegas)) {
            Flash::error('Bodegas no encontrado');
            Alert::error('Bodegas no encontrado');

            return redirect(route('bodegas.index'));
        }

        $this->bodegasRepository->delete($id);

        Flash::success('Bodegas borrado correctamente.');
        Flash::success('Bodegas borrado correctamente.');

        return redirect(route('bodegas.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebancosRequest;
use App\Http\Requests\UpdatebancosRequest;
use App\Repositories\bancosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class bancosController extends AppBaseController
{
    /** @var  bancosRepository */
    private $bancosRepository;

    public function __construct(bancosRepository $bancosRepo)
    {
        $this->bancosRepository = $bancosRepo;
        $this->middleware('permission:bancos-list');
        $this->middleware('permission:bancos-create', ['only' => ['create','store']]);
        $this->middleware('permission:bancos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bancos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the bancos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bancosRepository->pushCriteria(new RequestCriteria($request));
        $bancos = $this->bancosRepository->all();

        return view('bancos.index')
            ->with('bancos', $bancos);
    }

    /**
     * Show the form for creating a new bancos.
     *
     * @return Response
     */
    public function create()
    {
        return view('bancos.create');
    }

    /**
     * Store a newly created bancos in storage.
     *
     * @param CreatebancosRequest $request
     *
     * @return Response
     */
    public function store(CreatebancosRequest $request)
    {
        $input = $request->all();

        $bancos = $this->bancosRepository->create($input);

        Flash::success('Bancos guardado correctamente.');
        Alert::success('Bancos guardado correctamente.');

        return redirect(route('bancos.index'));
    }

    /**
     * Display the specified bancos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bancos = $this->bancosRepository->findWithoutFail($id);

        if (empty($bancos)) {
            Flash::error('Bancos no encontrado');
            Alert::error('Bancos no encontrado.');

            return redirect(route('bancos.index'));
        }

        return view('bancos.show')->with('bancos', $bancos);
    }

    /**
     * Show the form for editing the specified bancos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bancos = $this->bancosRepository->findWithoutFail($id);

        if (empty($bancos)) {
            Flash::error('Bancos no encontrado');
            Alert::error('Bancos no encontrado');

            return redirect(route('bancos.index'));
        }

        return view('bancos.edit')->with('bancos', $bancos);
    }

    /**
     * Update the specified bancos in storage.
     *
     * @param  int              $id
     * @param UpdatebancosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebancosRequest $request)
    {
        $bancos = $this->bancosRepository->findWithoutFail($id);

        if (empty($bancos)) {
            Flash::error('Bancos no encontrado');
            Alert::error('Bancos no encontrado');

            return redirect(route('bancos.index'));
        }

        $bancos = $this->bancosRepository->update($request->all(), $id);

        Flash::success('Bancos actualizado correctamente.');
        Alert::success('Bancos actualizado correctamente.');

        return redirect(route('bancos.index'));
    }

    /**
     * Remove the specified bancos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bancos = $this->bancosRepository->findWithoutFail($id);

        if (empty($bancos)) {
            Flash::error('Bancos no encontrado');
            Alert::error('Bancos no encontrado');

            return redirect(route('bancos.index'));
        }

        $this->bancosRepository->delete($id);

        Flash::success('Bancos borrado correctamente.');
        Flash::success('Bancos borrado correctamente.');

        return redirect(route('bancos.index'));
    }
}

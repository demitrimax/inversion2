<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecoddivisasRequest;
use App\Http\Requests\UpdatecoddivisasRequest;
use App\Repositories\coddivisasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class coddivisasController extends AppBaseController
{
    /** @var  coddivisasRepository */
    private $coddivisasRepository;

    public function __construct(coddivisasRepository $coddivisasRepo)
    {
        $this->coddivisasRepository = $coddivisasRepo;
        $this->middleware('permission:coddivisas-list');
        $this->middleware('permission:coddivisas-create', ['only' => ['create','store']]);
        $this->middleware('permission:coddivisas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:coddivisas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the coddivisas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->coddivisasRepository->pushCriteria(new RequestCriteria($request));
        $coddivisas = $this->coddivisasRepository->all();

        return view('coddivisas.index')
            ->with('coddivisas', $coddivisas);
    }

    /**
     * Show the form for creating a new coddivisas.
     *
     * @return Response
     */
    public function create()
    {
        return view('coddivisas.create');
    }

    /**
     * Store a newly created coddivisas in storage.
     *
     * @param CreatecoddivisasRequest $request
     *
     * @return Response
     */
    public function store(CreatecoddivisasRequest $request)
    {
        $input = $request->all();

        $coddivisas = $this->coddivisasRepository->create($input);

        Flash::success('Coddivisas guardado correctamente.');
        Alert::success('Coddivisas guardado correctamente.');

        return redirect(route('coddivisas.index'));
    }

    /**
     * Display the specified coddivisas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $coddivisas = $this->coddivisasRepository->findWithoutFail($id);

        if (empty($coddivisas)) {
            Flash::error('Coddivisas no encontrado');
            Alert::error('Coddivisas no encontrado.');

            return redirect(route('coddivisas.index'));
        }

        return view('coddivisas.show')->with('coddivisas', $coddivisas);
    }

    /**
     * Show the form for editing the specified coddivisas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $coddivisas = $this->coddivisasRepository->findWithoutFail($id);

        if (empty($coddivisas)) {
            Flash::error('Coddivisas no encontrado');
            Alert::error('Coddivisas no encontrado');

            return redirect(route('coddivisas.index'));
        }

        return view('coddivisas.edit')->with('coddivisas', $coddivisas);
    }

    /**
     * Update the specified coddivisas in storage.
     *
     * @param  int              $id
     * @param UpdatecoddivisasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecoddivisasRequest $request)
    {
        $coddivisas = $this->coddivisasRepository->findWithoutFail($id);

        if (empty($coddivisas)) {
            Flash::error('Coddivisas no encontrado');
            Alert::error('Coddivisas no encontrado');

            return redirect(route('coddivisas.index'));
        }

        $coddivisas = $this->coddivisasRepository->update($request->all(), $id);

        Flash::success('Coddivisas actualizado correctamente.');
        Alert::success('Coddivisas actualizado correctamente.');

        return redirect(route('coddivisas.index'));
    }

    /**
     * Remove the specified coddivisas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $coddivisas = $this->coddivisasRepository->findWithoutFail($id);

        if (empty($coddivisas)) {
            Flash::error('Coddivisas no encontrado');
            Alert::error('Coddivisas no encontrado');

            return redirect(route('coddivisas.index'));
        }

        $this->coddivisasRepository->delete($id);

        Flash::success('Coddivisas borrado correctamente.');
        Flash::success('Coddivisas borrado correctamente.');

        return redirect(route('coddivisas.index'));
    }
}

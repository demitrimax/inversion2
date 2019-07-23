<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatemetpagoRequest;
use App\Http\Requests\UpdatemetpagoRequest;
use App\Repositories\metpagoRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class metpagoController extends AppBaseController
{
    /** @var  metpagoRepository */
    private $metpagoRepository;

    public function __construct(metpagoRepository $metpagoRepo)
    {
        $this->metpagoRepository = $metpagoRepo;
        $this->middleware('permission:metpagos-list');
        $this->middleware('permission:metpagos-create', ['only' => ['create','store']]);
        $this->middleware('permission:metpagos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:metpagos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the metpago.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->metpagoRepository->pushCriteria(new RequestCriteria($request));
        $metpagos = $this->metpagoRepository->all();

        return view('metpagos.index')
            ->with('metpagos', $metpagos);
    }

    /**
     * Show the form for creating a new metpago.
     *
     * @return Response
     */
    public function create()
    {
        return view('metpagos.create');
    }

    /**
     * Store a newly created metpago in storage.
     *
     * @param CreatemetpagoRequest $request
     *
     * @return Response
     */
    public function store(CreatemetpagoRequest $request)
    {
        $input = $request->all();

        $metpago = $this->metpagoRepository->create($input);

        Flash::success('Método de pago creado correctamente.');
        Alert::success('Método de pago creado correctamente.');

        return redirect(route('metpagos.index'));
    }

    /**
     * Display the specified metpago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $metpago = $this->metpagoRepository->findWithoutFail($id);

        if (empty($metpago)) {
            Flash::error('Método de pagono encontrado');
            Alert::error('Método de pago no encontrado.');

            return redirect(route('metpagos.index'));
        }

        return view('metpagos.show')->with('metpago', $metpago);
    }

    /**
     * Show the form for editing the specified metpago.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $metpago = $this->metpagoRepository->findWithoutFail($id);

        if (empty($metpago)) {
            Flash::error('Método de pago no encontrado');
            Alert::error('Método de pago no encontrado');

            return redirect(route('metpagos.index'));
        }

        return view('metpagos.edit')->with('metpago', $metpago);
    }

    /**
     * Update the specified metpago in storage.
     *
     * @param  int              $id
     * @param UpdatemetpagoRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatemetpagoRequest $request)
    {
        $metpago = $this->metpagoRepository->findWithoutFail($id);

        if (empty($metpago)) {
            Flash::error('Método de pago no encontrado');
            Alert::error('Método de pago no encontrado');

            return redirect(route('metpagos.index'));
        }

        $metpago = $this->metpagoRepository->update($request->all(), $id);

        Flash::success('Método de pago actualizado correctamente.');
        Alert::success('Método de pago actualizado correctamente.');

        return redirect(route('metpagos.index'));
    }

    /**
     * Remove the specified metpago from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $metpago = $this->metpagoRepository->findWithoutFail($id);

        if (empty($metpago)) {
            Flash::error('Método de pago no encontrado');
            Alert::error('Método de pago no encontrado');

            return redirect(route('metpagos.index'));
        }

        $this->metpagoRepository->delete($id);

        Flash::success('Método de pago borrado correctamente.');
        Flash::success('Método de pago borrado correctamente.');

        return redirect(route('metpagos.index'));
    }
}

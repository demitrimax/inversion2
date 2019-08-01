<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefacturasRequest;
use App\Http\Requests\UpdatefacturasRequest;
use App\Repositories\facturasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class facturasController extends AppBaseController
{
    /** @var  facturasRepository */
    private $facturasRepository;

    public function __construct(facturasRepository $facturasRepo)
    {
        $this->facturasRepository = $facturasRepo;
        $this->middleware('permission:facturas-list');
        $this->middleware('permission:facturas-create', ['only' => ['create','store']]);
        $this->middleware('permission:facturas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:facturas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the facturas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facturasRepository->pushCriteria(new RequestCriteria($request));
        $facturas = $this->facturasRepository->all();

        return view('facturas.index')
            ->with('facturas', $facturas);
    }

    /**
     * Show the form for creating a new facturas.
     *
     * @return Response
     */
    public function create()
    {
        return view('facturas.create');
    }

    /**
     * Store a newly created facturas in storage.
     *
     * @param CreatefacturasRequest $request
     *
     * @return Response
     */
    public function store(CreatefacturasRequest $request)
    {
        $input = $request->all();

        $facturas = $this->facturasRepository->create($input);

        Flash::success('Factura guardada correctamente.');
        Alert::success('Factura guardada correctamente.');

        return redirect(route('facturas.index'));
    }

    /**
     * Display the specified facturas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facturas = $this->facturasRepository->findWithoutFail($id);

        if (empty($facturas)) {
            Flash::error('Factura no encontrada');
            Alert::error('Factura no encontrada.');

            return redirect(route('facturas.index'));
        }

        return view('facturas.show')->with('facturas', $facturas);
    }

    /**
     * Show the form for editing the specified facturas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facturas = $this->facturasRepository->findWithoutFail($id);

        if (empty($facturas)) {
            Flash::error('Factura no encontrada');
            Alert::error('Factura no encontrada');

            return redirect(route('facturas.index'));
        }

        return view('facturas.edit')->with('facturas', $facturas);
    }

    /**
     * Update the specified facturas in storage.
     *
     * @param  int              $id
     * @param UpdatefacturasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefacturasRequest $request)
    {
        $facturas = $this->facturasRepository->findWithoutFail($id);

        if (empty($facturas)) {
            Flash::error('Factura no encontrada');
            Alert::error('Factura no encontrada');

            return redirect(route('facturas.index'));
        }

        $facturas = $this->facturasRepository->update($request->all(), $id);

        Flash::success('Factura actualizada correctamente.');
        Alert::success('Factura actualizada correctamente.');

        return redirect(route('facturas.index'));
    }

    /**
     * Remove the specified facturas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facturas = $this->facturasRepository->findWithoutFail($id);

        if (empty($facturas)) {
            Flash::error('Factura no encontrada');
            Alert::error('Factura no encontrada');

            return redirect(route('facturas.index'));
        }

        $this->facturasRepository->delete($id);

        Flash::success('Factura borrada correctamente.');
        Alert::success('Factura borrada correctamente.');

        return redirect(route('facturas.index'));
    }
}

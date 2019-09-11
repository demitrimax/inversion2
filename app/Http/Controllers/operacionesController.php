<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateoperacionesRequest;
use App\Http\Requests\UpdateoperacionesRequest;
use App\Repositories\operacionesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\empresas;
use App\Models\bcuentas;
use App\Models\proveedores;
use App\Models\clasifica;
use App\Models\metpago;
use App\Models\facturas;
use App\Models\operaciones;

class operacionesController extends AppBaseController
{
    /** @var  operacionesRepository */
    private $operacionesRepository;

    public function __construct(operacionesRepository $operacionesRepo)
    {
        $this->operacionesRepository = $operacionesRepo;
        $this->middleware('permission:operaciones-list');
        $this->middleware('permission:operaciones-create', ['only' => ['create','store']]);
        $this->middleware('permission:operaciones-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:operaciones-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the operaciones.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->operacionesRepository->pushCriteria(new RequestCriteria($request));
        $operaciones = $this->operacionesRepository->orderBy('fecha', 'desc')->paginate(10);

        return view('operaciones.index')
            ->with('operaciones', $operaciones);
    }

    /**
     * Show the form for creating a new operaciones.
     *
     * @return Response
     */
    public function create()
    {
      $empresas = empresas::pluck('nombre','id');

      //dd($cuentas);
      $cuentas = bcuentas::all();
      $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
      $proveedores = proveedores::pluck('nombre','id');
      $categorias = clasifica::all();
      $metpago = metpago::pluck('nombre','id');
      $facturas = facturas::whereNull('operacion_id')->pluck('numfactura','id');

      foreach($categorias as $key=>$categoria){
         foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
          $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
        }
      }

        return view('operaciones.create')->with(compact('empresas','cuental','proveedores','subcategoriasAgrupadas','metpago', 'facturas'));
    }

    /**
     * Store a newly created operaciones in storage.
     *
     * @param CreateoperacionesRequest $request
     *
     * @return Response
     */
    public function store(CreateoperacionesRequest $request)
    {
        $input = $request->all();

        //$operaciones = $this->operacionesRepository->create($input);
        //operacion comisionable --- no guardar enviar a otra vista
        if($input['comisionable'] == 1){
          $empresaid = $input['empresa_id'];
          $empresa = empresas::find($empresaid);

          $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($empresaid) {
            $q->where('id',$empresaid);
          })->get();
          //dd($cuentas);
          $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
          $metpago = metpago::pluck('nombre','id');
          $proveedores = proveedores::pluck('nombre','id');

          $facturas = facturas::whereNull('operacion_id')->pluck('numfactura','id');
          $categorias = clasifica::all();
          foreach($categorias as $key=>$categoria){
             foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
              $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
            }
          }

          return view('operaciones.newoperacioncomisionable')->with(compact('cuental', 'empresa', 'metpago', 'facturas', 'proveedores', 'subcategoriasAgrupadas', 'input'));
        }
        $operaciones = new operaciones;
        $operaciones->monto = $input['monto'];
        $operaciones->empresa_id = $input['empresa_id'];
        $operaciones->cuenta_id = $input['cuenta_id'];
        $operaciones->proveedor_id = $input['proveedor_id'];
        $operaciones->numfactura = $input['numfactura'];
        $operaciones->subclasifica_id = $input['subclasifica_id'];
        $operaciones->tipo = $input['tipo'];
        $operaciones->metpago = $input['metpago'];
        $operaciones->concepto = $input['concepto'];
        $operaciones->comentario = $input['comentario'];
        $operaciones->fecha = $input['fecha'];
        $operaciones->save();

        if($request->input('facturas')){
          $montos = 0;
          foreach ($request->input('facturas') as $factura)
          {
            $facturas = facturas::find($factura);
            $facturas->operacion_id = $operaciones->id;
            $facturas->save();
            $montos += $facturas->monto;
          }
          $operaciones->monto = $montos;
          //actualizar el monto de la factura con los montos de la factura
          $operaciones->save();
        }

        Flash::success('Operación guardada correctamente.');
        Alert::success('Operación guardada correctamente.');

        return redirect(route('operaciones.index'));
    }

    /**
     * Display the specified operaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $operaciones = $this->operacionesRepository->findWithoutFail($id);

        if (empty($operaciones)) {
            Flash::error('Operación no encontrada');
            Alert::error('Operación no encontrada.');

            return redirect(route('operaciones.index'));
        }

        return view('operaciones.show')->with('operaciones', $operaciones);
    }

    /**
     * Show the form for editing the specified operaciones.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $operaciones = $this->operacionesRepository->findWithoutFail($id);

        if (empty($operaciones)) {
            Flash::error('Operación no encontrada');
            Alert::error('Operación no encontrada');

            return redirect(route('operaciones.index'));
        }
        $empresas = empresas::pluck('nombre','id');
        $empresaid = $operaciones->empresa_id;
        $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($empresaid) {
          $q->where('id',$empresaid);
        })->get();
        //dd($cuentas);
        $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
        $proveedores = proveedores::pluck('nombre','id');
        $categorias = clasifica::all();
        $metpago = metpago::pluck('nombre','id');
        foreach($categorias as $key=>$categoria){
           foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
            $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
          }
        }

        $facturas = facturas::whereNull('operacion_id')
                              ->orWhere('operacion_id', $operaciones->id)
                              ->orderBy('numfactura','asc')
                              ->pluck('numfactura','id');

        return view('operaciones.edit')->with(compact('operaciones','empresas', 'cuental', 'proveedores','subcategoriasAgrupadas','metpago', 'facturas'));
    }

    /**
     * Update the specified operaciones in storage.
     *
     * @param  int              $id
     * @param UpdateoperacionesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateoperacionesRequest $request)
    {
        $operaciones = $this->operacionesRepository->findWithoutFail($id);

        if (empty($operaciones)) {
            Flash::error('Operación no encontrada');
            Alert::error('Operación no encontrada');

            return redirect(route('operaciones.index'));
        }

        $operaciones = $this->operacionesRepository->update($request->all(), $id);

        if($request->input('facturas')){
          $montos = 0;
          foreach($operaciones->facturas as $factura)
          {
            $factua = facturas::find($factura->id);
            $factua->operacion_id = null;
            $factua->save();
          }
          foreach ($request->input('facturas') as $factura)
          {
            $facturas = facturas::find($factura);
            $facturas->operacion_id = $operaciones->id;
            $facturas->save();
            $montos += $facturas->monto;
          }
          $operaciones->monto = $montos;
          //actualizar el monto de la factura con los montos de la factura
          $operaciones->save();
        }


        Flash::success('Operación actualizada correctamente.');
        Alert::success('Operación actualizada correctamente.');

        return redirect(route('operaciones.index'));
    }

    /**
     * Remove the specified operaciones from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $operaciones = $this->operacionesRepository->findWithoutFail($id);

        if (empty($operaciones)) {
            Flash::error('Operación no encontrada');
            Alert::error('Operación no encontrada');

            return redirect(route('operaciones.index'));
        }

        $this->operacionesRepository->delete($id);

        Flash::success('Operación borrada correctamente.');
        Alert::success('Operación borrada correctamente.');

        return redirect(route('operaciones.index'));
    }
    public function operacionInventario($id, Request $request)
    {

      $empresa = empresas::find($id);
      $empresaid = $id;
      $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($empresaid) {
        $q->where('id',$empresaid);
      })->get();
      //dd($cuentas);
      $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
      $metpago = metpago::pluck('nombre','id');
      $proveedores = proveedores::pluck('nombre','id');

      $facturas = facturas::whereNull('operacion_id')->pluck('numfactura','id');
      $categorias = clasifica::all();
      foreach($categorias as $key=>$categoria){
         foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
          $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
        }
      }

      return view('operaciones.newoperacioninv')->with(compact('cuental', 'empresa', 'metpago', 'facturas', 'proveedores', 'subcategoriasAgrupadas'));
    }
}

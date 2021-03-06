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
use App\Models\opcomisionables;
use App\Models\minventario;
use Yajra\Datatables\Datatables;

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

        if(!empty($request->search)){
            $searchFields = ['numfactura','concepto','comentario'];
            $operaciones = \App\Models\operaciones::where(function($query) use($request, $searchFields){
              $searchWildcard = '%' . $request->search . '%';
              foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
              }
            })->orderBy('fecha', 'desc')->paginate(10);
          }

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
      $proveedores = proveedores::orderBy('nombre', 'asc')->pluck('nombre','id');
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
        //operacion comisionable --- guardar los atributos de la comisión.
        //dd($input);
        $operaciones = new operaciones;
        if(isset($input['comisionable']) && $input['comisionable'] == 1){
          /*
            if($input['comisionable'] == 1 && $input['tipo'] == 'Salida'){
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
              $categorias = clasifica::where('tip','E')->get();
              foreach($categorias as $key=>$categoria){
                 foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
                  $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
                }
              }
              $categorias = clasifica::where('tip','I')->get();
              foreach($categorias as $key=>$categoria){
                 foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
                  $subcategoriasAgrupadasIng[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
                }
              }
              $cuentasporfuera = $empresa->cuentas->where('porfuera', 1)->pluck('nomcuentasaldo','id');
                return view('operaciones.newoperacioncomisionable')->with(compact('cuental', 'empresa', 'metpago', 'facturas', 'proveedores', 'subcategoriasAgrupadas', 'subcategoriasAgrupadasIng','cuentasporfuera', 'input'));
              }
              */
              $operaciones->comisionable = 1;
              $operaciones->monto_comision = $input['monto'];
        }

        if(isset($input['inventariable']) && $input['inventariable'] == 1 ){
            $empresas = empresas::pluck('nombre','id');
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
            $categorias = clasifica::where('tip','E')->get();
            foreach($categorias as $key=>$categoria){
               foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
                $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
              }
            }
            $categorias = clasifica::where('tip','I')->get();

          return view('operaciones.newoperacioninv')->with(compact('empresa','cuental','metpago','facturas','categorias','proveedores','subcategoriasAgrupadas','request'));
        }

        if( isset($input['monto_comision']) && $input['monto_comision'] > 0){
          $operaciones->monto = $input['monto_comision'];
          $operaciones->monto_comision = $input['monto'];
        } else {
          $operaciones->monto = $input['monto'];
        }

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

        return redirect(route('operaciones.show', [$operaciones->id]));
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

        $empresaid = $operaciones->empresa_id;
        $empresa = empresas::find($empresaid);

        $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($empresaid) {
          $q->where('id',$empresaid);
        })->get();
        $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
        $ctadestino = $cuentas->filter(function($cuenta) {
                                  return $cuenta->porfuera == 1 || $cuenta->efectivo == 1;
                                })
                              ->pluck('nomcuentasaldo', 'id');

        $metpago = metpago::pluck('nombre','id');
        $proveedores = proveedores::pluck('nombre','id');
        $categorias = clasifica::where('tip','E')->get();
        foreach($categorias as $key=>$categoria){
           foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
            $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
          }
        }


        return view('operaciones.show')->with(compact('operaciones',
                                                      'cuental',
                                                      'metpago',
                                                      'proveedores',
                                                      'subcategoriasAgrupadas',
                                                      'ctadestino'));
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

        return redirect(route('operaciones.show', [$operaciones->id]));
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

    public function opDelete($id)
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

    public function saveOperacionComisionable(Request $request)
    {
      $input = $request->all();

      if(isset($input['tipo']) && $input['tipo'] == 'Efectivo' ){
        if($input['cuenta_id'] == $input['ctadestino_id'] ){
          $mensaje = 'No se puede hacer un traspaso de la misma cuenta!';
          Alert::error($mensaje);
          Flash::error($mensaje);
          return back()->withInput($request->input());
        }
        $traspaso  = new \App\Models\optraspasos;
        $traspaso->origen_cta = $input['cuenta_id'];
        $traspaso->destino_cta = $input['ctadestino_id'];
        $traspaso->operacion_id = $input['operacion_origen'];
        $traspaso->monto = $input['monto'];
        $traspaso->concepto = $input['concepto'];
        $traspaso->fecha = $input['fecha'];
        $traspaso->save();

        $mensaje = 'Se ha registrado correctamente.';
        Alert::success($mensaje);
        Flash::success($mensaje);
        return back();
      }

      $operaciones = new operaciones;
      $operaciones->monto = $input['monto'];
      $operaciones->empresa_id = $input['empresa_id'];
      $operaciones->cuenta_id = $input['cuenta_id'];
      if(isset($input['tipo']) && $input['tipo'] == 'Efectivo'){
        $operaciones->tipo = 'Salida';
        $operaciones->proveedor_id = 1;
      }else {
        $operaciones->proveedor_id = $input['proveedor_id'];
        $operaciones->tipo = $input['tipo'];
      }
      //$operaciones->numfactura = $input['numfactura'];
      $operaciones->subclasifica_id = $input['subclasifica_id'];
      $operaciones->metpago = $input['metpago'];
      $operaciones->concepto = $input['concepto'];
      //$operaciones->comentario = $input['comentario'];
      $operaciones->fecha = $input['fecha'];
      //$operaciones->comisionable = 1; //IDENTIFICADOR DE OPERACION COMISIONABLE
      $operaciones->save();


      $op_origen = $input['operacion_origen'];
      $op_comisionable = new opcomisionables;
      $op_comisionable->id_operacion = $input['operacion_origen'];
      $op_comisionable->id_op_comision = $operaciones->id;
      $op_comisionable->save();



    Alert::success('Operación Vinculada guardada correctamente');
    Flash::success('Operación Vinculada guardada correctamente');

    return redirect(route('operaciones.show', [$op_origen]));
  }

  public function saveOperacionInventario(Request $request)
  {
    $input = $request->all();
    //dd($input);
    //REGISTRAR LA OPERACION
    $operacion = new operaciones;
    $operacion->monto = $input['monto_op'];
    $operacion->empresa_id = $input['empresa_id'];
    $operacion->cuenta_id = $input['cuenta_id'];
    $operacion->proveedor_id = $input['proveedor_id'];
    $operacion->numfactura = $input['numfactura'];
    $operacion->subclasifica_id = $input['subclasifica_id'];
    $operacion->tipo = 'Salida';
    $operacion->metpago = $input['metpago'];
    $operacion->concepto = $input['concepto'];
    $operacion->comentario = $input['comentario'];
    $operacion->fecha = $input['fecha'];
    $operacion->save();
    //REGISTRAR LOS PRODUCTOS DE Inventario
    foreach($input['codigo_2'] as $key=>$inventario)
    {
      if(!empty($input['codigo_2'][$key])){
        $opInventario = new minventario;
        $opInventario->concepto = $input['concepto_2'][$key];
        $opInventario->marca = $input['marca_2'][$key];
        $opInventario->modelo = $input['modelo_2'][$key];
        $opInventario->codigo = $input['codigo_2'][$key];
        $opInventario->montocompra = $input['monto_2'][$key];
        $opInventario->operacion_id = $operacion->id;
        $opInventario->save();
      }
    }
    $mensaje = 'Operación guardada correctamente';
    Alert::success($mensaje);
    Flash::success($mensaje);

    Return redirect(route('operaciones.show', [$operacion->id]));
  }

  public function ListaOperaciones(Request $request)
  {
        $operaciones = \App\Models\operaciones::orderBy('fecha', 'desc')->get();

        return Datatables::of($operaciones)
                          ->addColumn('acciones', '{{$id}}')
                          ->addColumn('iconos', function($operaciones) {
                            $iconos = $operaciones->tipo == 'Entrada' ? '<span class="badge badge-success"  title="Abono"><i class="fa fa-arrow-circle-down"></i></span>' : '<span class="badge badge-warning"  title="Cargo"><i class="fa fa-arrow-circle-up"></i></span>' ;
                            $iconos .= $operaciones->inventarios->count() > 0 ?  '<span class="badge badge-primary" title="Operación Inventario"><i class="fa fa-crosshairs"></i></span>' : '';
                            $iconos .= $operaciones->comisionable == 1 ?  '<span class="badge badge-danger" title="Operación Comisionable"><i class="fa fa-asterisk"></i></span>' : '' ;
                            return $iconos;
                          })
                          ->addColumn('iconoss', function($operaciones) {
                            $iconos['entrada'] = $operaciones->tipo == 'Entrada' ?  true :  false;
                            $iconos['inventario'] = $operaciones->inventarios->count() > 0 ?   true : false ;
                            $iconos['comisionable'] = $operaciones->comisionable == 1 ? true : false;
                            return $iconos;
                          })
                          ->addColumn('comisionable', function($operaciones) {
                            $resultado = $operaciones->comisionable == 1  ?  true :  false;
                            return $resultado;
                          })
                          ->addColumn('entrada', function($operaciones) {
                            $resultado = $operaciones->tipo == 'Entrada' ?  true :  false;
                            return $resultado;
                          })
                          ->addColumn('inventario', function($operaciones) {
                            $resultado = $operaciones->inventarios->count() > 0 ?  true :  false;
                            return $resultado;
                          })

                          ->addColumn('empresanombre', function($operaciones) {
                            return $operaciones->empresa->nombre;
                          })
                          ->addColumn('categoria', function($operaciones) {
                            return $operaciones->subclasifica->nombre;
                          })
                          ->addColumn('proveedor', function($operaciones) {
                            return $operaciones->proveedor->nombre;
                          })
                          ->editColumn('fecha', function ($operaciones) {
                            return $operaciones->fecha->format('Y-m-d');
                          })
                          ->editColumn('monto', function ($operaciones) {
                            return number_format($operaciones->monto,2);
                          })
                          /*->editColumn('matricula', function ($alumno) {
                            return '<a href="'. route('alumnos.edit',[$alumno->id]) .'">'.$alumno->matricula.'</a>';
                          })*/
                          ->make(true);
  }

}

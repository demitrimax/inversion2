<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateinvoperacionRequest;
use App\Http\Requests\UpdateinvoperacionRequest;
use App\Repositories\invoperacionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\invproveedores;
use App\Models\clientes;
use App\Models\productos;
use App\Models\invoperacion;
use App\Models\invdetoperacion;
use App\Models\bodegas;
use App\Models\facturara;
use Auth;

class invoperacionController extends AppBaseController
{
    /** @var  invoperacionRepository */
    private $invoperacionRepository;

    public function __construct(invoperacionRepository $invoperacionRepo)
    {
        $this->invoperacionRepository = $invoperacionRepo;
        $this->middleware('permission:invoperacions-list');
        $this->middleware('permission:invoperacions-create', ['only' => ['create','store']]);
        $this->middleware('permission:invoperacions-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:invoperacions-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the invoperacion.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->invoperacionRepository->pushCriteria(new RequestCriteria($request));
        $invoperacions = $this->invoperacionRepository->all();

        return view('invoperacions.index')
            ->with('invoperacions', $invoperacions);
    }

    /**
     * Show the form for creating a new invoperacion.
     *
     * @return Response
     */
    public function create()
    {
      $proveedores = invproveedores::pluck('nombre','id');
      $clientes = clientes::pluck('nombre','id');
        return view('invoperacions.create')->with(compact('proveedores','clientes'));
    }

    /**
     * Store a newly created invoperacion in storage.
     *
     * @param CreateinvoperacionRequest $request
     *
     * @return Response
     */
    public function store(CreateinvoperacionRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $invoperacion = $this->invoperacionRepository->create($input);

        Flash::success('Operación de Inventario guardado correctamente.');
        Alert::success('Operación de Inventario guardado correctamente.');

        return redirect(route('invoperacions.index'));
    }

    /**
     * Display the specified invoperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $invoperacion = $this->invoperacionRepository->findWithoutFail($id);

        if (empty($invoperacion)) {
            Flash::error('Operación de Inventario no encontrado');
            Alert::error('Operación de Inventario no encontrado.');

            return redirect(route('invoperacions.index'));
        }

        $proveedores = invproveedores::pluck('nombre','id');

        return view('invoperacions.pedido')->with('invoperacion', $invoperacion);
    }

    /**
     * Show the form for editing the specified invoperacion.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $invoperacion = $this->invoperacionRepository->findWithoutFail($id);

        if (empty($invoperacion)) {
            Flash::error('Operación de Inventario no encontrado');
            Alert::error('Operación de Inventario no encontrado');

            return redirect(route('invoperacions.index'));
        }
        $proveedores = invproveedores::pluck('nombre','id');
        $clientes = clientes::pluck('nombre','id');

        return view('invoperacions.edit')->with(compact('invoperacion','proveedores','clientes'));
    }

    /**
     * Update the specified invoperacion in storage.
     *
     * @param  int              $id
     * @param UpdateinvoperacionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateinvoperacionRequest $request)
    {
        $invoperacion = $this->invoperacionRepository->findWithoutFail($id);

        if (empty($invoperacion)) {
            Flash::error('Operación de Inventario no encontrado');
            Alert::error('Operación de Inventario no encontrado');

            return redirect(route('invoperacions.index'));
        }
        //dd($request);
        $invoperacion = $this->invoperacionRepository->update($request->all(), $id);

        Flash::success('Operación de Inventario actualizado correctamente.');
        Alert::success('Operación de Inventario actualizado correctamente.');

        return redirect(route('invoperacions.index'));
    }

    /**
     * Remove the specified invoperacion from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $invoperacion = $this->invoperacionRepository->findWithoutFail($id);

        if (empty($invoperacion)) {
            Flash::error('Operación de Inventario no encontrado');
            Alert::error('Operación de Inventario no encontrado');

            return redirect(route('invoperacions.index'));
        }
        $detalleaeliminar = invdetoperacion::where('operacion_id',$invoperacion->id)->get();
        $this->invoperacionRepository->delete($id);

        foreach($detalleaeliminar as $detalle){
          $detalle->delete();
        }


        Flash::success('Operación de Inventario borrado correctamente.');
        Alert::success('Operación de Inventario borrado correctamente.');

        return redirect(route('invoperacions.index'));
    }

    public function VerInventario()
    {
      $productos = productos::all();
      return view('inventario.estatus')->with(compact('productos'));
    }
    public function entrada()
    {
      $proveedores = invproveedores::orderBy('nombre','asc')->pluck('nombre','id');
      $productos = productos::orderBy('nombre','asc')->pluck('nombre','id');
      $bodegas = bodegas::pluck('nombre','id');
      $operaciontipo = 'entrada';
      $facturara = facturara::pluck('nombre', 'id');
      return view('inventario.entrada')->with(compact('proveedores','productos','bodegas', 'operaciontipo', 'facturara'));
    }
    public function salida()
    {
      $clientes = clientes::orderBy('nombre','asc')->pluck('nombre','id');
      $productos = productos::orderBy('nombre','asc')->get();
      $productos = $productos->where('stock', '>', 0 )->pluck('nomproductostock','id');
      $bodegas = bodegas::pluck('nombre','id');
      $operaciontipo = 'salida';
      $facturaras = facturara::pluck('nombre','id');
      return view('inventario.salida')->with(compact('clientes','productos','bodegas', 'operaciontipo', 'facturaras'));
    }
    public function regEntrada(Request $request)
    {
      $input = $request->all();
      //dd($input);

      $string = $input['aTotal'];
      $monto  = floatval($string);
      //dd($monto);

      $invoperacion = new invoperacion;
      $invoperacion->usuario_id = Auth::user()->id;
      $invoperacion->tipo_mov = 'Entrada';
      $invoperacion->proveedor_id = $input['proveedor_id'];
      $invoperacion->total = $input['aTotal'];
      $invoperacion->subtotal = $input['aSubtotal'];
      $invoperacion->iva = $input['aIva'];
      $invoperacion->fecha = $input['fecha'];
      $invoperacion->facturara_id = $input['facturara_id'];
      $invoperacion->numfactura = $input['numfactura'];
      $invoperacion->estatus = 'S';
      $invoperacion->save();

      foreach($input['cantidad'] as $key=>$cantidad ){
        if(!empty($input['producto'][$key])){
          $invdetoperacion = new invdetoperacion;
          $invdetoperacion->operacion_id = $invoperacion->id;
          $invdetoperacion->producto_id = $input['producto'][$key];
          $invdetoperacion->cantidad = $input['cantidad'][$key];
          $invdetoperacion->punitario = $input['importecon'][$key];
          $invdetoperacion->importe = $input['montoconcepto'][$key];
          $invdetoperacion->tipo_operacion = 'Entrada';
          $invdetoperacion->fecha = $input['fecha'];
          $invdetoperacion->bodega_id = $input['bodega_id'];
          $invdetoperacion->estatus = 'S';
          $invdetoperacion->save();
        }

      }
      Alert::success('Solicitud de Requisición registrado correctamente');
      Flash::success('Solicitud de Requisición registrado correctamente');

      //return redirect('inventario.estatus');
      return redirect(route('invoperacions.show', [$invoperacion->id]));
    }
    public function regSalida(Request $request)
    {
      $input = $request->all();
      //dd($input);

      $string = $input['aTotal'];
      $monto  = floatval($string);
      //dd($monto);
      //verificar existencias antes
      $flag = 0;
      foreach($input['cantidad'] as $key=>$cantidad ){
        if(!empty($input['producto'][$key])){

          $productoid = $input['producto'][$key];
          //$cantidad = $input['cantidad'][$key];
          $bodega_id = $input['bodega_id'];
          //dd($cantidad);
          $elproducto = productos::find($productoid);
          $stock = $elproducto->stock;
          //dd($stock);
          if( $cantidad > $stock) {
            $mensaje = 'La cantidad solicitada del '.$elproducto->nombre.' sobrepasa el nivel de stock ('.$elproducto->stock.')';
            Alert::error($mensaje);
            Flash::error($mensaje);
            $flag = 1;
          }
          if($flag == 1){
            return back();
          }

        }
      }
      $invoperacion = new invoperacion;
      $invoperacion->usuario_id = Auth::user()->id;
      $invoperacion->tipo_mov = 'Salida';
      $invoperacion->cliente_id = $input['cliente_id'];
      $invoperacion->subtotal = $input['aSubtotal'];
      $invoperacion->iva = $input['aIva'];
      $invoperacion->total = $monto;
      $invoperacion->fecha = $input['fecha'];
      $invoperacion->numfactura = $input['numfactura'];
      $invoperacion->estatus = 'F';
      $invoperacion->save();

      foreach($input['cantidad'] as $key=>$cantidad ){
        if(!empty($input['producto'][$key])){
          $invdetoperacion = new invdetoperacion;
          $invdetoperacion->operacion_id = $invoperacion->id;
          $invdetoperacion->producto_id = $input['producto'][$key];
          $invdetoperacion->cantidad = $input['cantidad'][$key];
          $invdetoperacion->punitario = $input['importecon'][$key];
          $invdetoperacion->importe = $input['montoconcepto'][$key];
          $invdetoperacion->tipo_operacion = 'Salida';
          $invdetoperacion->fecha = $input['fecha'];
          $invdetoperacion->bodega_id = $input['bodega_id'];
          $invdetoperacion->save();
        }

      }
      Alert::success('Salida de Producto registrado correctamente');
      Flash::success('Salida de Producto registrado correctamente');

      return redirect(route('invoperacions.show', [$invoperacion->id]));
      //return back();
    }
    public function precioventaproducto($id)
    {
      $producto = productos::find($id);
      $precioventa = ['nombre'=>$producto->nombre, 'pventa' => $producto->pventa, 'pcompra' => $producto->pcompra, 'umedida'=>$producto->umedida ];
      return $precioventa;
    }
    public function surtidototalproducto($id)
    {
      $detoperacion = invdetoperacion::find($id);

      if(empty($detoperacion)){
        Flash::error('Operación de Inventario no encontrado');
        Alert::error('Operación de Inventario no encontrado');
        return back();
      }

      $detoperacion->estatus = 'T';
      $detoperacion->save();
      Flash::success('Surtido en su Totalidad');
      Alert::success('Surtido en su Totalidad');

      return back();

    }
    public function surtidoparcialproducto(Request $request, $id)
    {
      $input = $request->all();
      $detoperacionid = $input['detoperacionid'];
      $detoperacion = invdetoperacion::find($detoperacionid);

      if(empty($detoperacionid)){
        Flash::error('No se encontró el ID de la operación.');
        Alert::error('No se encontró el ID de la operación.');
        return back();
      }

      if(empty($detoperacion)){
        Flash::error('Operación de Inventario no encontrado');
        Alert::error('Operación de Inventario no encontrado');
        return back();
      }

      $detoperacion->estatus = 'P';
      $detoperacion->parcial = $input['parcial'];
      $detoperacion->save();
      Flash::success('Surtido Parcialmente');
      Alert::success('Surtido Parcialmente');

      return back();

    }
    public function verinformeproductos()
    {
      $productos = productos::all();
      return view('productos.vreporte')->with(compact('productos'));
    }
    static function cambiarestado($id)
    {
      $operacion = invoperacion::find($id);
      foreach($operacion->invdetoperacions as $key=>$operaproducto){
          $estatus[] = $operaproducto->estatus;
      }


    }
    public function informeVer1()
    {
      $productos = productos::all();
      return view('inventario.reportev1')->with(compact('productos'));
    }
    public function informeVer2()
    {
      $productos = productos::all();
      return view('inventario.reportev2')->with(compact('productos'));
    }
}

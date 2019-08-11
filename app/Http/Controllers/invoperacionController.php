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
use App\Models\proveedores;
use App\Models\clientes;
use App\Models\productos;
use App\Models\invoperacion;
use App\Models\invdetoperacion;
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
      $proveedores = proveedores::pluck('nombre','id');
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

        $invoperacion = $this->invoperacionRepository->create($input);

        Flash::success('Invoperacion guardado correctamente.');
        Alert::success('Invoperacion guardado correctamente.');

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
            Flash::error('Invoperacion no encontrado');
            Alert::error('Invoperacion no encontrado.');

            return redirect(route('invoperacions.index'));
        }
        $proveedores = proveedores::pluck('nombre','id');

        return view('invoperacions.show')->with('invoperacion', $invoperacion);
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
            Flash::error('Invoperacion no encontrado');
            Alert::error('Invoperacion no encontrado');

            return redirect(route('invoperacions.index'));
        }

        return view('invoperacions.edit')->with('invoperacion', $invoperacion);
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
            Flash::error('Invoperacion no encontrado');
            Alert::error('Invoperacion no encontrado');

            return redirect(route('invoperacions.index'));
        }

        $invoperacion = $this->invoperacionRepository->update($request->all(), $id);

        Flash::success('Invoperacion actualizado correctamente.');
        Alert::success('Invoperacion actualizado correctamente.');

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
            Flash::error('Invoperacion no encontrado');
            Alert::error('Invoperacion no encontrado');

            return redirect(route('invoperacions.index'));
        }

        $this->invoperacionRepository->delete($id);

        Flash::success('Invoperacion borrado correctamente.');
        Flash::success('Invoperacion borrado correctamente.');

        return redirect(route('invoperacions.index'));
    }
    public function VerInventario()
    {
      $productos = productos::all();
      return view('inventario.estatus')->with(compact('productos'));
    }
    public function entrada()
    {
      $proveedores = proveedores::pluck('nombre','id');
      $productos = productos::pluck('nombre','id');
      return view('inventario.entrada')->with(compact('proveedores','productos'));
    }
    public function regEntrada(Request $request)
    {
      $input = $request->all();
      //dd($input);

      $string = $input['cTotal'];
      $monto  = floatval($string);

      $invoperacion = new invoperacion;
      $invoperacion->usuario_id = Auth::user()->id;
      $invoperacion->tipo_mov = 'Entrada';
      $invoperacion->proveedor_id = $input['proveedor_id'];
      $invoperacion->monto = $monto;
      $invoperacion->fecha = $input['fecha'];
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
          $invdetoperacion->save();
        }

      }
      Alert::success('Entrada de Producto registrado correctamente');
      Flash::success('Entrada de Producto registrado correctamente');

      //return redirect('inventario.estatus');
      return back();
    }
}
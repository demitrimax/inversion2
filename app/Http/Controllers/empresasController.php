<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateempresasRequest;
use App\Http\Requests\UpdateempresasRequest;
use App\Repositories\empresasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\operaciones;
use App\Models\bancos;
use App\Models\creditos;
use App\Models\metpago;
use App\Models\bcuentas;
use App\Models\proveedores;
use App\Models\movcreditos;
use App\Models\corridafinanciera;
use App\Models\cproyectos;
use App\Models\movinversion;
use App\Models\coddivisas;
use Auth;

class empresasController extends AppBaseController
{
    /** @var  empresasRepository */
    private $empresasRepository;

    public function __construct(empresasRepository $empresasRepo)
    {
        $this->empresasRepository = $empresasRepo;
        $this->middleware('permission:empresas-list');
        $this->middleware('permission:empresas-create', ['only' => ['create','store']]);
        $this->middleware('permission:empresas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:empresas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the empresas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->empresasRepository->pushCriteria(new RequestCriteria($request));
        $empresas = $this->empresasRepository->all();

        return view('empresas.index')
            ->with('empresas', $empresas);
    }

    /**
     * Show the form for creating a new empresas.
     *
     * @return Response
     */
    public function create()
    {
        return view('empresas.create');
    }

    /**
     * Store a newly created empresas in storage.
     *
     * @param CreateempresasRequest $request
     *
     * @return Response
     */
    public function store(CreateempresasRequest $request)
    {
        $input = $request->all();

        $empresas = $this->empresasRepository->create($input);

        Flash::success('Empresa creada correctamente.');
        Alert::success('Empresa creada correctamente.');

        return redirect(route('empresas.index'));
    }

    /**
     * Display the specified empresas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $empresas = $this->empresasRepository->findWithoutFail($id);

        if (empty($empresas)) {
            Flash::error('Empresa no encontrada');
            Alert::error('Empresa no encontrada.');

            return redirect(route('empresas.index'));
        }
        $empresaid = $empresas->id;
        $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($empresaid) {
          $q->where('id',$empresaid);
        })->get();
        //dd($cuentas);
        $cuental = $cuentas->pluck('nomcuentasaldo', 'id');
        //dd($cuentas);
        $bancos = bancos::pluck('nombrecorto','id');
        $creditos = creditos::pluck('nombre', 'id');
        $metpago = metpago::pluck('nombre','id');
        $proveedores = proveedores::pluck('nombre','id');
        $proyectos = cproyectos::pluck('nombre','id');
        $divisas = coddivisas::pluck('nombre','codigo');
        return view('empresas.show')->with(compact('empresas','bancos','creditos','metpago','cuental', 'proveedores', 'proyectos','divisas'));
    }

    /**
     * Show the form for editing the specified empresas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $empresas = $this->empresasRepository->findWithoutFail($id);

        if (empty($empresas)) {
            Flash::error('Empresa no encontrada');
            Alert::error('Empresa no encontrada');

            return redirect(route('empresas.index'));
        }

        return view('empresas.edit')->with('empresas', $empresas);
    }

    /**
     * Update the specified empresas in storage.
     *
     * @param  int              $id
     * @param UpdateempresasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateempresasRequest $request)
    {
        $empresas = $this->empresasRepository->findWithoutFail($id);

        if (empty($empresas)) {
            Flash::error('Empresa no encontrada');
            Alert::error('Empresa no encontrada');

            return redirect(route('empresas.index'));
        }

        $empresas = $this->empresasRepository->update($request->all(), $id);

        Flash::success('Empresa actualizada correctamente.');
        Alert::success('Empresa actualizada correctamente.');

        return redirect(route('empresas.index'));
    }

    /**
     * Remove the specified empresas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $empresas = $this->empresasRepository->findWithoutFail($id);

        if (empty($empresas)) {
            Flash::error('Empresa no encontrada');
            Alert::error('Empresa no encontrada');

            return redirect(route('empresas.index'));
        }
        if($empresas->cuentas->count()>0){
          Flash::error('No se puede eliminar, la empresa tiene cuentas activas.');
          Alert::error('No se puede eliminar, la empresa tiene cuentas activas.');

          return redirect(route('empresas.index'));
        }
        if($empresas->operaciones->count()>0){
          Flash::error('No se puede eliminar, la empresa tiene operaciones activas.');
          Alert::error('No se puede eliminar, la empresa tiene operaciones activas.');

          return redirect(route('empresas.index'));
        }


        $this->empresasRepository->delete($id);

        Flash::success('Empresa borrada correctamente.');
        Alert::success('Empresa borrada correctamente.');

        return redirect(route('empresas.index'));
    }
    public function regoper(Request $request)
    {
      $input = $request->all();
      $operacion = new operaciones;
      $operacion->monto = $input['monto_op'];
      $operacion->empresa_id = $input['empresa_id'];
      $operacion->cuenta_id = $input['cuenta_id'];
      $operacion->proveedor_id = $input['proveedor_id'];
      $operacion->numfactura = $input['numfactura'];
      $operacion->tipo = $input['tipo'];
      $operacion->fecha = $input['fecha'];
      $operacion->metpago = $input['metpago'];
      $operacion->concepto = $input['concepto'];
      $operacion->comentario = $input['comentario'];
      $operacion->save();

      //$empresas = $this->empresasRepository->create($input);

      Flash::success('Operación registrada correctamente.');
      Alert::success('Operación registrada correctamente.');

      return back();
    }

    public function pagocredito(Request $request)
    {
      $input = $request->all();
      //dd($request);

      $cuenta = bcuentas::find($input['cuenta_id']);
      $montopagar = corridafinanciera::find($input['pagoref']);
      //verificar que se hayan encontrado la cuenta y el monto a pagar
      if(empty($cuenta)){
        Alert::error('Cuenta no encontrada.');
        Flash::error('Cuenta no encontrada.');
        return back();
      }
      if (empty($montopagar)){
        Alert::error('No se encontró la referencia del pago.');
        Flash::error('No se encontró la referencia del pago.');
        return back();
      }
      //verificar que la cuenta tenga fondos suficientes para realizar la operación
      $saldodisponible = $cuenta->saldocuenta;
      if ($saldodisponible < $montopagar->mpago){
        Alert::error('El saldo en la cuenta no es suficiente para pagar.');
        Flash::error('El saldo en la cuenta no es suficiente para pagar.');
        return back();
      }
      //obtener el monto que se paagará
      $movcredito = new movcreditos;
      $movcredito->credito_id = $input['credito_id'];
      $movcredito->tipo = 'Entrada';
      $movcredito->monto = $montopagar->mpago;
      $movcredito->user_id = Auth::user()->id;
      $movcredito->cuenta_id = $input['cuenta_id'];
      $movcredito->fecha = $input['fecha'];
      $movcredito->comentario = $input['comentario'];
      $movcredito->corrida_id = $montopagar->id;
      $movcredito->save();
      //registrar el monto pagado ya liberado
      $montopagar->pagado_at = date('Y-m-d');
      $montopagar->save();

      Alert::success('Se registró correctamente el pago de inversión.');
      Flash::success('Se registró correctamente el pago de inversión.');

      return back();
    }

    public function inverproy(Request $request)
    {
      $input = $request->all();

      //verificar que la cuenta exista
      $cuenta = bcuentas::find($input['cuenta_id']);
      if(empty($cuenta)){
        Alert::error('La cuenta seleccionada no existe.');
        Flash::error('La cuenta seleccionada no existe.');
        return back();
      }

      $inversion = new movinversion;
      $inversion->cuenta_id = $input['cuenta_id'];
      $inversion->proyecto_id = $input['proyecto_id'];
      $inversion->user_id = Auth::user()->id;
      $inversion->monto = $input['monto'];
      $inversion->tinteres = $input['tinteres'];
      $inversion->fecha = $input['fecha'];
      $inversion->metpago = $input['metpago'];
      $inversion->observaciones = $input['observaciones'];
      $inversion->save();

      Alert::success('Se ha registrado existosamente la inversión');
      Flash::success('Se ha registrado existosamente la inversión');

      return back();

    }

    public function elimoper($id)
    {

      $operacion = operaciones::find($id);
      if(empty($operacion))
      {
        Alert::error('No se encuentra la operación');
        Flash::error('No se encuentra la operación');
        return back();
      }
      $operacion->delete();

      Alert::success('Se ha eliminado existosamente la operación');
      Flash::success('Se ha eliminado existosamente la operación');
      return back();
    }
}

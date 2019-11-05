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
use App\Models\clasifica;
use App\Models\subclasifica;
use App\Models\facturas;
use App\Models\empresas;
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
        $categorias = clasifica::all();
        $operaciones = operaciones::where('empresa_id',$empresaid)->orderBy('fecha', 'desc')->paginate(10);

        $inversiones = collect([]);
        foreach($cuentas as $cuenta){
          foreach($cuenta->inversiones as $inversion)
            $inversiones->push($inversion);
        }

        foreach($categorias as $key=>$categoria){
           foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
            $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
          }
        }
        $toperacionesg = operaciones::where('empresa_id',$empresaid)
                                    ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                    ->groupBy('subclasifica_id')
                                    ->groupBy('fechag')
                                    ->orderBy('subclasifica_id', 'asc')
                                    ->get();
        $toperacionesporcuenta = operaciones::where('empresa_id',$empresaid)
                                ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                ->groupBy('cuenta_id')
                                ->groupBy('fechag')
                                ->orderBy('cuenta_id', 'asc')
                                ->get();
                                //dd($toperacionesporcuenta);
        $fechasopg = operaciones::where('empresa_id', $empresaid)
                                ->selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                ->groupBy('fechag')
                                ->get();
        //dd($toperacionesg);
        $facturas = facturas::whereNull('operacion_id')->pluck('numfactura','id');

        return view('empresas.show')->with(compact('empresas','bancos','creditos','metpago','cuental', 'proveedores', 'proyectos','divisas', 'inversiones', 'categorias', 'subcategoriasAgrupadas', 'operaciones', 'toperacionesg', 'fechasopg', 'facturas', 'toperacionesporcuenta'));
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
      //verificar que la operación incluya información de Inventario+


        if(isset($input['inventariable']) && $input['inventariable'] == 1 ){
            $input['monto'] = $input['monto_op'];
            //$input = array_merge($request->all(), ['index' => 'value']);
            //agregar una variable al request bag
            $request->request->add(['monto' => $input['monto_op']]);
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
      //dd($input['inventariable']);
      $operacion = new operaciones;
      $operacion->monto = $input['monto_op'];
      $operacion->empresa_id = $input['empresa_id'];
      $operacion->cuenta_id = $input['cuenta_id'];
      $operacion->proveedor_id = $input['proveedor_id'];
      $operacion->numfactura = $input['numfactura'];
      $operacion->tipo = $input['tipo'];
      $operacion->fecha = $input['fecha'];
      $operacion->metpago = $input['metpago'];
      $operacion->subclasifica_id = $input['subclasifica_id'];
      $operacion->concepto = $input['concepto'];
      $operacion->comentario = $input['comentario'];
      $operacion->save();

      $montos = 0;
      //es un arreglo?
      if( is_array($request->input['facturas']) ) {
        foreach ($request->input('facturas') as $factura)
        {
          $facturas = facturas::find($factura);
          $facturas->operacion_id = $operacion->id;
          $facturas->save();
          $montos += $facturas->monto;
        }
        //actualizar el monto de la factura con los montos de la factura
        $operacion->monto = $montos;
      }

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
    public function eliminver($id)
    {
      $inversion  = movinversion::find($id);

      if(empty($inversion))
      {
        Alert::error('No se encuentra la Inversión a eliminar');
        Flash::error('No se encuentra la Inversión a eliminar');
        return back();
      }
      $inversion->delete();

      Alert::success('Se ha eliminado existosamente la inversión');
      Flash::success('Se ha eliminado existosamente la inversión');
      return back();

    }

    public function detalleoperaciones($id, $mesanio, $subclasificaid)
    {
        $empresas = $this->empresasRepository->findWithoutFail($id);
        $operaciones = operaciones::selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                    ->where('subclasifica_id', $subclasificaid)
                                    ->whereRaw('DATE_FORMAT(fecha, "%m-%y") = "'.$mesanio.'"')
                                    ->where('subclasifica_id', $subclasificaid)
                                    ->get();
      //dd($operaciones);
      $subclasifica = subclasifica::find($subclasificaid);
      if(empty($operaciones)){
        Alert::error('sin datos para mostrar');
        Flash::error('sin datos para mostrar');
        return back();
      }

        return view('empresas.detoperaciones')->with(compact('empresas', 'operaciones', 'mesanio', 'subclasifica'));
    }
}

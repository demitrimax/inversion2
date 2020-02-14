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
use \Illuminate\Database\Eloquent\Collection;

use Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper\Html as HtmlHelper;

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
        $anioactual = date('Y');
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
        $operaciones = operaciones::where('empresa_id',$empresaid)
                                  ->orderBy('fecha', 'desc')
                                  ->paginate(10);

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
        $toperacionesg = operaciones::where('operaciones.empresa_id',$empresaid)
                                    ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                    ->whereRaw('year(fecha) = ?', [date('Y')])
                                    ->join('cat_subclasifica', 'operaciones.subclasifica_id', '=', 'cat_subclasifica.id')
                                    ->leftjoin('orden_categorias', 'cat_subclasifica.clasifica_id', '=', 'orden_categorias.categoria_id')
                                    ->where('orden_categorias.empresa_id', $empresaid)
                                    ->groupBy('subclasifica_id')
                                    ->groupBy('fechag')
                                    ->orderBy('orden_categorias.orden', 'asc')
                                    ->orderBy('cat_subclasifica.clasifica_id', 'asc')
                                    ->orderBy('subclasifica_id', 'asc')
                                    ->get();
                                    //dd($toperacionesg);
        $toperacionesporcuenta = operaciones::where('empresa_id',$empresaid)
                                ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                ->whereRaw('year(fecha) = ?', [date('Y')])
                                ->groupBy('cuenta_id')
                                ->groupBy('fechag')
                                ->orderBy('cuenta_id', 'asc')
                                ->get();
                                //dd($toperacionesporcuenta);
        $fechasopg = operaciones::where('empresa_id', $empresaid)
                                ->selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                ->whereRaw('year(fecha) = ?', [date('Y')])
                                ->groupBy('fechag')
                                ->get();
        //dd($toperacionesg);
        $facturas = facturas::whereNull('operacion_id')->pluck('numfactura','id');

        return view('empresas.show')->with(compact('empresas',
                                                    'bancos',
                                                    'creditos',
                                                    'metpago',
                                                    'cuental',
                                                    'proveedores',
                                                    'proyectos',
                                                    'divisas',
                                                    'inversiones',
                                                    'categorias',
                                                    'subcategoriasAgrupadas',
                                                    'operaciones',
                                                    'toperacionesg',
                                                    'fechasopg',
                                                    'facturas',
                                                    'toperacionesporcuenta'));
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
        $categorias = clasifica::all();
        $subcategorias = subclasifica::all();
        $categoriasorden = $empresas->categorias->sortBy('pivot_orden');
        //dd($categoriasorden);
        if (empty($empresas)) {
            Flash::error('Empresa no encontrada');
            Alert::error('Empresa no encontrada');

            return redirect(route('empresas.index'));
        }

        return view('empresas.edit')->with(compact('empresas', 'subcategorias', 'categorias'));
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

    public function OrdenCategoriasJson(Request $request, $id)
    {
      $input = $request->all();
      $empresa = empresas::find($id);

      if(empty($empresa)){
        $mensaje = ['texto'=>'No se encuentra la empresa', 'type'=>'error'];
        return $mensaje;
      }
      $valores = $input;

      $lascategorias = collect($valores['categorias'])->map(function ($categorias) {
            return (object) $categorias;
        });
        $lasidcategorias = $empresa->categorias->pluck('id');
        //attach agregar categorias nuevas a la empresa con el orden
        foreach($lascategorias->whereNotIn('id', $lasidcategorias ) as $nuevacategoria){
          $micategoria = clasifica::find($nuevacategoria->id);
          $empresa->categorias()->attach($micategoria, ['orden'=>$nuevacategoria->orden, 'alias'=>$nuevacategoria->alias]);
          //return $micategoria;
        }
        //actualizar el orden de todas las categorias que tiene asociada la empresa
        foreach($empresa->categorias->whereIn( 'pivot.categoria_id',$lascategorias->pluck('id') ) as $existecategoria){
          //$micategoria = clasifica::find($existecategoria);
          //$empresa->categorias()->attach($micategoria, ['orden'=>$orden]);
          foreach($lascategorias as $ordencat){
            if($existecategoria->id == $ordencat->id){
              $existecategoria->pivot->orden = $ordencat->orden;
              //if($existecategoria->nombre <> $ordencat->alias){
                    $existecategoria->pivot->alias = $ordencat->alias;
              //}
              $existecategoria->pivot->save();
            }

          }

        }

      $mensaje = ['texto' => 'Éxito en la asociación de orden.', 'type'=>'success'];

      return $mensaje;
    }

    public function OrdenSubcategoriasJson($empresaid){
      $empresa = empresas::find($empresaid);
      $subcategorias = subclasifica::all();
      if (empty($empresa)){
        return ['mensaje' => 'No se encuentra la empresa', 'type'=>'error'];
      }
      $categorias = $empresa->categorias;
      if(empty($categorias)){
        return ['mensaje' => 'Empresa sin categorias asociasas', 'type'=>'error'];
      }
      $response = [];


      foreach($categorias->sortBy('pivot.orden') as $categoria){
        $children = [];

        if($subcategorias->where('clasifica_id', $categoria->id)->count() > 0) {
          foreach( $subcategorias->where('clasifica_id', $categoria->id) as $misub ) {
            $children[] = ['id'=>$misub->id, 'text'=>$misub->nombre ];
          }
        }

        $response[] = ['id'=>$categoria->id, 'text'=> $categoria->pivot->alias ? $categoria->pivot->alias : $categoria->nombre,
              'children'=>$children];
      }
      return $response;
    }

    public function reporte($id, $anio)
    {
      $empresa = empresas::find($id);
      $aniorep = $anio;
      //validar anio
      //$aniorep = $anio;
      $anios = operaciones::selectRaw('year(fecha) as anio, empresa_id')
                          ->distinct('anio')
                          ->where('empresa_id',$id)
                          ->orderBy('anio')
                          ->get();
      //dd($anios);

      $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($id) {
        $q->where('id',$id);
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
      $operaciones = operaciones::where('empresa_id',$id)->orderBy('fecha', 'desc')->paginate(10);

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

      $toperacionesg = operaciones::where('empresa_id',$id)
                                  ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                  ->whereRaw('year(fecha) = ?', [$aniorep])
                                  ->groupBy('subclasifica_id')
                                  ->groupBy('fechag')
                                  ->orderBy('subclasifica_id', 'asc')
                                  ->get();
      $toperacionesporcuenta = operaciones::where('empresa_id',$id)
                              ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                              ->whereRaw('year(fecha) = ?', [$aniorep])
                              ->groupBy('cuenta_id')
                              ->groupBy('fechag')
                              ->orderBy('cuenta_id', 'asc')
                              ->get();

      $fechasopg = operaciones::where('empresa_id', $id)
                              ->selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                              ->whereRaw('year(fecha) = ?', [$aniorep])
                              ->groupBy('fechag')
                              ->get();

      $catunicas = '';
      $latabla = new Collection();
      $latabla->push([ 'meses' => collect(['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']) ]);

      foreach($toperacionesg->sortBy('subclasifica.clasifica.orden')->unique('subclasifica') as $operacion){

          if($catunicas <> $operacion->subclasifica->clasifica->nombre ){
            $categoria = $operacion->subclasifica->clasifica->nombre;
            $latabla->push( ['categorias' => collect([$categoria])] );
            $catunicas = $categoria;
          }
          $subcategoria = $operacion->subclasifica->nombre;
          //$latabla['categorias'] [$categoria][] = $subcategoria;
      }

        $mitabla = collect($latabla);

      return view('empresas.reporte')->with(compact('empresa',
                                                    'toperacionesg',
                                                    'toperacionesporcuenta',
                                                    'subcategoriasAgrupadas',
                                                    'operaciones',
                                                    'fechasopg',
                                                    'anios',
                                                    'anio',
                                                    'latabla',
                                                    'mitabla'));
    }

    public function reporteExcel($id, $anio)
    {

      $empresa = empresas::find($id);
      $aniorep = $anio;
      //validar anio
      //$aniorep = $anio;
      $anios = operaciones::selectRaw('year(fecha) as anio, empresa_id')
                          ->distinct('anio')
                          ->where('empresa_id',$id)
                          ->orderBy('anio')
                          ->get();
      //dd($anios);
      /*
      $cuentas = bcuentas::with('empresa')->whereHas('empresa', function($q) use ($id) {
        $q->where('id',$id);
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
      */
      $categorias = clasifica::all();
      $operaciones = operaciones::where('empresa_id',$id)->orderBy('fecha', 'desc')->paginate(10);

      foreach($categorias as $key=>$categoria){
         foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
          $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
        }
      }

      $toperacionesg = operaciones::where('empresa_id',$id)
                                  ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                  ->whereRaw('year(fecha) = ?', [$aniorep])
                                  ->groupBy('subclasifica_id')
                                  ->groupBy('fechag')
                                  ->orderBy('subclasifica_id', 'asc')
                                  ->get();
      $toperacionesporcuenta = operaciones::where('empresa_id',$id)
                              ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                              ->whereRaw('year(fecha) = ?', [$aniorep])
                              ->groupBy('cuenta_id')
                              ->groupBy('fechag')
                              ->orderBy('cuenta_id', 'asc')
                              ->get();

      $fechasopg = operaciones::where('empresa_id', $id)
                              ->selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                              ->whereRaw('year(fecha) = ?', [$aniorep])
                              ->groupBy('fechag')
                              ->get();

      $archivo = '/plantillaExcel/plantilla_resumenop2.xlsx';
      $reader = IOFactory::createReader('Xlsx');
      $spreadsheet = $reader->load(public_path($archivo));
      $spreadsheet->getProperties()->setCreator('pi.corporation-tym.mx')
          ->setLastModifiedBy('pi.corporation-tym.mx')
          ->setTitle('Formato Reporte de Presupuesto Anual')
          ->setSubject('Formato de Reporte de Presupuesto Anual')
          ->setDescription('Reporte de Presupuesto')
          ->setKeywords('REPORTE DE PRESUPUESTO')
          ->setCategory('PRESUPUESTO');
      $wizard = new HtmlHelper();
      $SheetTitle = 'PRESUPUESTO '.$anio;
      $spreadsheet->getActiveSheet()->setTitle($SheetTitle);
      $wizard = new HtmlHelper();

      $Columnas = ['C','D','E','F','G','H','I','J','K','L','M','N','O'];
      $categoriasSub = [];
      $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      $leyenda = 'Reporte de Presupuesto obtenido de '.$enlace_actual.', el día '.date('d-m-Y H:i:s');
      $spreadsheet->getActiveSheet()->setCellValue('A1', $leyenda);

      $Row = 8;
      //todas las categorias que se van a imprimir
      $catunicas = '';
      $subcategoriaCount = 0;
      $categoriasg = [];
      foreach($toperacionesg->sortBy('subclasifica.clasifica.orden')->unique('subclasifica') as $operacion){
        //si es el inicio de la categoria entonces

        if($catunicas <> $operacion->subclasifica->clasifica->nombre ){

            $categoria = $operacion->subclasifica->clasifica->nombre;

          if($Row > 8){
            $txsubtotalCategoria = '<b>Subtotal '.$CategoriaAnterior.'</b>';
            $nombreCat = $wizard->toRichTextObject($txsubtotalCategoria);
            $spreadsheet->getActiveSheet()->setCellValue('A'.$Row, $nombreCat);
            $tipo = $operacion->subclasifica->clasifica->tip;
            $categoriasg[$categoria] = ['categoria' => $categoria, 'row'=>$Row, 'rowI'=>$Row-$subcategoriaCount, 'tipo'=>$tipo ];
            $subcategoriaCount = 0;
          }

          $Row = $Row + 2;


          //$spreadsheet->getActiveSheet()->insertNewRowBefore($Row, 1);

          $categoria = '<font size="10" face="arial"><b>'.$categoria.'</b> </font>';
          $nombrecategoria = $wizard->toRichTextObject($categoria);

          $spreadsheet->getActiveSheet()->setCellValue('A'.$Row, $nombrecategoria);
          $Row++;
          $catunicas = $operacion->subclasifica->clasifica->nombre;

        }

        $subcategoriaCount ++;
        $subcategoria = $operacion->subclasifica->nombre;
        $spreadsheet->getActiveSheet()->setCellValue('A'.$Row, strtoupper($subcategoria));

        $categoriasSub[$subcategoria] = ['categoria' => $categoria, 'subcategoria'=>$subcategoria, 'row'=>$Row ];

        $Row++;
        $CategoriaAnterior = $operacion->subclasifica->clasifica->nombre;
        $tipoAnterior = $operacion->subclasifica->clasifica->tip;
      }


      //ultimo subtotal de categoria
      $txsubtotalCategoria = '<b>Subtotal '.$CategoriaAnterior.'</b>';
      $nombreCat = $wizard->toRichTextObject($txsubtotalCategoria);
      $spreadsheet->getActiveSheet()->setCellValue('A'.$Row, $nombreCat);
      $tipo = $operacion->subclasifica->clasifica->tip;
      $categoriasg[$CategoriaAnterior.'_'] = ['categoria' => $CategoriaAnterior.'_', 'row'=>$Row, 'rowI'=>$Row-$subcategoriaCount, 'tipo'=>$tipo ];

      //dd($categoriasg);

      foreach ($fechasopg as $keyMonths => $fechas) {
        //titulo de las columnas
        //$spreadsheet->getActiveSheet()->insertNewColumnBefore($Columnas[$keyMonths], 1);
        $spreadsheet->getActiveSheet()->setCellValue($Columnas[$keyMonths].'4', strtoupper($fechas->mes));


        if(isset($saldofiscal)){

            $saldoinicial = $saldofiscal + $saldoporfuera;
            $spreadsheet->getActiveSheet()->setCellValue($Columnas[$key].'5', $saldoinicial);

              if(isset($saldofiscal)){
                $spreadsheet->getActiveSheet()->setCellValue($Columnas[$key].'5', $saldofiscal);
              }

              if(isset($saldoporfuera)){
                $spreadsheet->getActiveSheet()->setCellValue($Columnas[$key].'6', $saldoporfuera);
              }

          }//fin if saldofiscal
          //obtener la lista de todas las categorias que va haber


          //bucle de las operaciones
          foreach($toperacionesg->where('fechag',$fechas->fechag)->sortBy('subclasifica.clasifica.orden') as $key=>$operacion) {
            //obtener la fila donde va

            foreach($categoriasSub as $subcategoria){
              //dd($subcategoria);
              if ($subcategoria['subcategoria'] == $operacion->subclasifica->nombre){

                $miRow = $subcategoria['row'];
                $elmonto = $operacion->montog;
                $spreadsheet->getActiveSheet()->setCellValue($Columnas[$keyMonths].$miRow, $elmonto);
              }
            }
          }

          foreach ($categoriasg as $categoriag) {

              $RowSubtotal = $categoriag['row'];
              $RowFin = $categoriag['row'] - 1;
              $RowIni = $categoriag['rowI'];
              $tipo = $categoriag['tipo'];

              $spreadsheet->getActiveSheet()->getCell($Columnas[$keyMonths].$RowSubtotal)->getCalculatedValue();

              $formula = '=SUM('.$Columnas[$keyMonths].$RowIni.':'.$Columnas[$keyMonths].$RowFin.')';
              $spreadsheet->getActiveSheet()->setCellValue($Columnas[$keyMonths].$RowSubtotal, $formula);
              $spreadsheet->getActiveSheet()->getStyle( $Columnas[$keyMonths].$RowSubtotal )->getFont()->setBold( true );
              if ($tipo == 'E') {
                    $spreadsheet->getActiveSheet()->getStyle( $Columnas[$keyMonths].$RowSubtotal )->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED ));
              }
              if ($tipo == 'I') {
                    $spreadsheet->getActiveSheet()->getStyle( $Columnas[$keyMonths].$RowSubtotal )->getFont()->setColor(new \PhpOffice\PhpSpreadsheet\Style\Color( \PhpOffice\PhpSpreadsheet\Style\Color::COLOR_DARKBLUE ));
              }
          }


      } //fin de las columnas


      // Redirect output to a client’s web browser (Xlsx)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="REPORTE_'.$SheetTitle.'.xlsx"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');

      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;
    }
}

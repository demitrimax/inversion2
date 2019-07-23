<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecreditosRequest;
use App\Http\Requests\UpdatecreditosRequest;
use App\Repositories\creditosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\efinanciera;
use App\Models\movcreditos;
use Auth;
use App\Models\cproyectos;
use App\Models\empresas;
use App\Models\bcuentas;
use App\Models\corridafinanciera;
use App\Models\creditos;
use App\Models\metpago;
use App\Models\operaciones;
use Carbon\Carbon;

class creditosController extends AppBaseController
{
    /** @var  creditosRepository */
    private $creditosRepository;

    public function __construct(creditosRepository $creditosRepo)
    {
        $this->creditosRepository = $creditosRepo;
        $this->middleware('permission:creditos-list');
        $this->middleware('permission:creditos-create', ['only' => ['create','store']]);
        $this->middleware('permission:creditos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:creditos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the creditos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->creditosRepository->pushCriteria(new RequestCriteria($request));
        $creditos = $this->creditosRepository->all();

        return view('creditos.index')
            ->with('creditos', $creditos);
    }

    /**
     * Show the form for creating a new creditos.
     *
     * @return Response
     */
    public function create()
    {
        $financieras = efinanciera::pluck('nombre','id');
        $empresas = empresas::pluck('nombre','id');
        return view('creditos.create')->with(compact('financieras','empresas'));
    }

    /**
     * Store a newly created creditos in storage.
     *
     * @param CreatecreditosRequest $request
     *
     * @return Response
     */
    public function store(CreatecreditosRequest $request)
    {
        $input = $request->all();

        $creditos = $this->creditosRepository->create($input);

        Flash::success('Creditos guardado correctamente.');
        Alert::success('Creditos guardado correctamente.');

        return redirect(route('creditos.index'));
    }

    /**
     * Display the specified creditos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $creditos = $this->creditosRepository->findWithoutFail($id);

        if (empty($creditos)) {
            Flash::error('Creditos no encontrado');
            Alert::error('Creditos no encontrado.');

            return redirect(route('creditos.index'));
        }
        $empresas = empresas::pluck('nombre','id');
        $cuentas = bcuentas::all();
        $cuentas = $cuentas->pluck('nomcuenta','id');
        $metpagos = metpago::pluck('nombre','id');
        return view('creditos.show')->with(compact('creditos','empresas','cuentas','metpagos'));
    }

    /**
     * Show the form for editing the specified creditos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $creditos = $this->creditosRepository->findWithoutFail($id);

        if (empty($creditos)) {
            Flash::error('Creditos no encontrado');
            Alert::error('Creditos no encontrado');

            return redirect(route('creditos.index'));
        }
        $empresas = empresas::pluck('nombre','id');
        $financieras = efinanciera::pluck('nombre','id');
        $cuentamep = bcuentas::whereHas('empresa')->get();
        $empresaid = $creditos->empresa_id;
        $cuentasemp = bcuentas::whereHas('empresa', function($q) use($empresaid) {
              $q->whereIn('empresas_id', [$empresaid]);
            })->get();
          $cuentasempresa = $cuentasemp->pluck('nomcuentasaldo','id');
        return view('creditos.edit')->with(compact('creditos','financieras','empresas','cuentasempresa'));
    }

    /**
     * Update the specified creditos in storage.
     *
     * @param  int              $id
     * @param UpdatecreditosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecreditosRequest $request)
    {
        $creditos = $this->creditosRepository->findWithoutFail($id);

        if (empty($creditos)) {
            Flash::error('Creditos no encontrado');
            Alert::error('Creditos no encontrado');

            return redirect(route('creditos.index'));
        }

        $creditos = $this->creditosRepository->update($request->all(), $id);

        Flash::success('Creditos actualizado correctamente.');
        Alert::success('Creditos actualizado correctamente.');

        return redirect(route('creditos.show', [$creditos->id]));
    }

    /**
     * Remove the specified creditos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $creditos = $this->creditosRepository->findWithoutFail($id);

        if (empty($creditos)) {
            Flash::error('Creditos no encontrado');
            Alert::error('Creditos no encontrado');

            return redirect(route('creditos.index'));
        }

        $this->creditosRepository->delete($id);

        Flash::success('Creditos borrado correctamente.');
        Flash::success('Creditos borrado correctamente.');

        return redirect(route('creditos.index'));
    }

    public function regmov(Request $request)
    {
      $input = $request->all();

      $movimiento = new movcreditos;
      $movimiento->credito_id = $input['credito_id'];
      $movimiento->cuenta_id = $input['cuenta_id'];
      $movimiento->tipo = $input['tipo'];
      $movimiento->monto = $input['monto'];
      $movimiento->fecha = $input['fecha'];
      $movimiento->comentario = $input['comentario'];
      $movimiento->user_id = Auth::user()->id;
      $movimiento->metpago_id = $input['metpago'];
      $movimiento->save();
      Alert::success('Movimiento registrado correctamente');
      return back();
    }
    public function getCuentasEmpresa($empresaid)
    {

      $cuentas = bcuentas::has('empresa')->get();
      //dd($cuentas);
      foreach($cuentas as $cuenta){
        foreach($cuenta->empresa as $empresa){
          if($empresa->id == $empresaid){
                    $accounts[] = $cuenta;
          }
        }


      }
      //dd($accounts);
      //$getcuentas[]=[];
      if(!empty($accounts)) {
        foreach($accounts as $cuenta)
        {
            $getcuentas[] = ['id'=>$cuenta->id, 'nombre'=>$cuenta->nomcuentasaldo];
        }
      }else{
        $getcuentas[] = ['id' => '', 'nombre'=>'Sin cuentas' ];
      }


      return $getcuentas;
    }

    public function crearCorridaFinanciera($id)
    {
        $credito = creditos::find($id);

        $primerpagfecha = $credito->finicio;
		    $ultimopagfecha = $credito->ftermino;
        $meseslibres    = $credito->meseslibres;
		    $linea          = 0;
		    $monto          = $credito->monto_inicial;
		    $tasa           = $credito->tasainteres;
        $tasamensual    = ($tasa/12);
		    $numdias        = $credito->finicio->diffInDays($credito->ftermino);
        $anios          = $credito->finicio->diffInYears($credito->ftermino);
		    $numpagos       = $credito->finicio->diffInMonths($credito->ftermino)+1;
		//cantidad final con el interes de la tasa
        $montofinal     = $monto * (($tasa/100)+1);
		    $pagofijo       = $monto / ($numpagos - $credito->meseslibres);
        $saldocapital   = $monto;
		    $interesi       = $pagofijo*($tasamensual);
		    $interes        = 0;
		    $total          = 0;
        $line           = 0;
        $pcapital       = 0;
        function pagoint( $rt, $pv, $Tn, $n)
        {
          //Tasa de Interes mensual $rt = $tasainteres /12
          //Cantidad de Coutas $Tn
          // Valor Presente $pv
          // couta a calcular $n
          $rt = $rt/100;
          //$pagointeres = ($pv * $rt * (($rt+1) ** ($Tn+1) - ($rt+1) ** $n )) / (( $rt+1 )*( (( $rt+1 ) ** $Tn) - 1));
          $pagointeres =($pv*$rt*(($rt + 1)**($Tn + 1) - ($rt + 1)**$n)) / (($rt + 1)* (($rt + 1)**$Tn - 1));
          return $pagointeres;
        }

        //verificar que no exista la corrida financiera

        $corrida = corridafinanciera::where('credito_id', $id)->get();
        if ($corrida->count()==$numpagos){
            //en caso que exista se actualiza la información

        }
        else {
            //si no existe, crear la corrida financiera

                for($i = $primerpagfecha; $i <= $ultimopagfecha; $i->addMonth() )
                {
                    $corrida = new corridafinanciera;
                    $linea++;
                    $corrida->credito_id = $id;
                    if( $linea > $meseslibres ){
                        $line = $linea - $credito->meseslibres;
                        $pcapital = $pagofijo;
                    }
                    $corrida->numpago = $line;
                    $corrida->anio = $credito->finicio->diffInYears($i)+1;
                    $corrida->sdocapital = $saldocapital;
                    $corrida->pagcapital = $pcapital;
                    if($line==0){
                        $corrida->pintereses = $pinteres = pagoint($tasamensual, $saldocapital, $numpagos, $line+1);
                    }
                    else{
                        $corrida->pintereses = $pinteres = pagoint($tasamensual, $saldocapital, $numpagos, $line);
                    }

                    $corrida->mpago = $mpago = $pcapital+$pinteres;
                    $corrida->saldocapital =  $saldocapital = ($saldocapital+$pinteres) - $mpago;
                    $corrida->fecha = $i;
                    $corrida->save();
                }

        }
        Alert::success('Se ha creado la corrida financiera correctamente');
        Flash::success('Se ha creado la corrida financiera correctamente');
        return back();

    }
    public function getCreditoPagos($id)
    {
      $from = new Carbon('first day of this month'); //date('Y-m-'.'01');
      $to = new Carbon('last day of this month');
      $pagos = [];
      $fechainicial = corridafinanciera::min('fecha');
      $corridas = corridafinanciera::where('credito_id',$id)->whereBetween('fecha',[$fechainicial,$to])->where('pagado_at',null)->get();
      foreach($corridas as $key=>$corrida){
        $pagos[] = ['id'=>$corrida->id, 'nombre'=>$corrida->pagoyfecha];
      }

      return $pagos;
    }
}

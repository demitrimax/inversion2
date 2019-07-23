<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use App\Models\movcreditos;
use App\Models\operaciones;
use App\Models\corridafinanciera;
use App\Models\empresas;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Alert::success('Prueba de SweetAlert');
        $hoy = date('Y-m-d');
        $movcredpagoshoy = movcreditos::where('fecha',$hoy)->where('tipo','Entrada')->get();
        $oppagoshoy = operaciones::where('created_at',$hoy)->where('tipo','Salida')->get();
        $pagoshoy = $movcredpagoshoy->sum('monto') + $oppagoshoy->sum('monto');

        $from = new Carbon('first day of this month'); //date('Y-m-'.'01');
        $to = new Carbon('last day of this month');
        $fechainicial = corridafinanciera::min('fecha');
        $corridafinan = corridafinanciera::whereBetween('fecha',[$from,$to])->where('pagado_at',null)->get();
        $pagopend = $corridafinan->sum('mpago');
        $intereses = $corridafinan->sum('pintereses');
        $corridafinan = corridafinanciera::whereBetween('fecha',[$fechainicial,$to])->where('pagado_at',null)->get();
        $totalpagopend = $corridafinan->sum('mpago');
        $totalinteres = $corridafinan->sum('pintereses');
        $business = empresas::get();
        //dd($empresas);
        //dd($oppagoshoy);
        return view('home')->
                with(compact('movcredpagoshoy',
                              'oppagoshoy',
                              'pagopend',
                              'intereses',
                              'totalpagopend',
                              'totalinteres',
                              'pagoshoy',
                              'business'
                            ));
    }
}

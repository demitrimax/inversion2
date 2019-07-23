<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatebcuentasRequest;
use App\Http\Requests\UpdatebcuentasRequest;
use App\Repositories\bcuentasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\bancos;
use App\Models\empresas;
use App\Models\coddivisas;

class bcuentasController extends AppBaseController
{
    /** @var  bcuentasRepository */
    private $bcuentasRepository;

    public function __construct(bcuentasRepository $bcuentasRepo)
    {
        $this->bcuentasRepository = $bcuentasRepo;
        $this->middleware('permission:bcuentas-list');
        $this->middleware('permission:bcuentas-create', ['only' => ['create','store']]);
        $this->middleware('permission:bcuentas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:bcuentas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the bcuentas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->bcuentasRepository->pushCriteria(new RequestCriteria($request));
        $bcuentas = $this->bcuentasRepository->all();

        return view('bcuentas.index')
            ->with('bcuentas', $bcuentas);
    }

    /**
     * Show the form for creating a new bcuentas.
     *
     * @return Response
     */
    public function create()
    {
        $bancos = bancos::pluck('nombrecorto','id');
        $empresas = empresas::pluck('nombre','id');
        $divisas = coddivisas::pluck('nombre', 'codigo');
        return view('bcuentas.create')->with(compact('bancos','empresas', 'divisas'));
    }

    /**
     * Store a newly created bcuentas in storage.
     *
     * @param CreatebcuentasRequest $request
     *
     * @return Response
     */
    public function store(CreatebcuentasRequest $request)
    {
        $input = $request->all();

        $bcuentas = $this->bcuentasRepository->create($input);

        if(!empty($input['empresa_id'])){
          $empresa = empresas::find($input['empresa_id']);
          $bcuentas->empresa()->attach($empresa);
        }

        Flash::success('Cuenta guardada correctamente.');
        Alert::success('Cuenta guardada correctamente.');

        if (!empty($input['redirect'])){

          $redirecciona = $input['redirect'];
          return redirect(route($redirecciona, [$input['empresa_id']]));
        }

        return redirect(route('bcuentas.index'));
    }

    /**
     * Display the specified bcuentas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bcuentas = $this->bcuentasRepository->findWithoutFail($id);

        if (empty($bcuentas)) {
            Flash::error('Cuenta no encontrada');
            Alert::error('Cuenta no encontrada.');

            return redirect(route('bcuentas.index'));
        }

        $movimientos = collect([]);
        //hacer un array donde se almacenen todas las operaciones
        //operaciones de credito
        foreach($bcuentas->creditos as $credito){
          $movimientos->push([
            'fecha'=>$credito->finicio,
            'tipo'=>'Abono',
            'clase'=>'credito',
            'monto'=>$credito->monto_inicial,
            'concepto'=>$credito->nombre,
           ]);

        }

        foreach($bcuentas->inversiones as $inversion){
          $movimientos->push([
            'fecha' => $inversion->fecha,
            'tipo'  => 'Cargo',
            'clase' => 'inversion',
            'monto' => $inversion->monto,
            'concepto' => 'Inversion en proyecto '.$inversion->proyecto->nombre,
          ]);
        }

        foreach ($bcuentas->operaciones as $operacion){
          $movimientos->push([
            'fecha' => $operacion->fecha,
            'tipo'  => $operacion->tipo == 'Entrada' ? 'Abono' : 'Cargo',
            'clase' => 'operacion',
            'monto' => $operacion->monto,
            'concepto'  => $operacion->concepto,
          ]);

        }
        $movimientos = $movimientos->sortBy('fecha');
        //dd($movimientos);

        return view('bcuentas.show')->with(compact('bcuentas','movimientos'));
    }

    /**
     * Show the form for editing the specified bcuentas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $bcuentas = $this->bcuentasRepository->findWithoutFail($id);

        if (empty($bcuentas)) {
            Flash::error('Cuenta no encontrada');
            Alert::error('Cuenta no encontrada');

            return redirect(route('bcuentas.index'));
        }
        $bancos = bancos::pluck('nombrecorto','id');
        $empresas = empresas::pluck('nombre','id');
        $divisas = coddivisas::pluck('nombre', 'codigo');
        return view('bcuentas.edit')->with(compact('bcuentas','bancos','empresas', 'divisas'));
    }

    /**
     * Update the specified bcuentas in storage.
     *
     * @param  int              $id
     * @param UpdatebcuentasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatebcuentasRequest $request)
    {
        $bcuentas = $this->bcuentasRepository->findWithoutFail($id);

        if (empty($bcuentas)) {
            Flash::error('Cuenta no encontrada');
            Alert::error('Cuenta no encontrada');

            return redirect(route('bcuentas.index'));
        }

        $bcuentas = $this->bcuentasRepository->update($request->all(), $id);

        Flash::success('Cuenta actualizada correctamente.');
        Alert::success('Cuenta actualizada correctamente.');

        return redirect(route('bcuentas.index'));
    }

    /**
     * Remove the specified bcuentas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $bcuentas = $this->bcuentasRepository->findWithoutFail($id);
        $input = $request->all();

        if (empty($bcuentas)) {
            Flash::error('Cuenta no encontrada');
            Alert::error('Cuenta no encontrada');

            return redirect(route('bcuentas.index'));
        }
        if ($bcuentas->operaciones->count>0){
              Flash::error('No se puede eliminar, la cuenta tiene registros de operaciones.');
              Alert::error('No se puede eliminar, la cuenta tiene registros de operaciones.');

          return back();
        }

        $this->bcuentasRepository->delete($id);

        Flash::success('Cuenta borrada correctamente.');
        Alert::success('Cuenta borrada correctamente.');

        if (!empty($input['redirect'])){

          $redirecciona = $input['redirect'];
          return redirect(route($redirecciona, [$input['empresa_id']]));
        }

        return redirect(route('bcuentas.index'));
    }
}

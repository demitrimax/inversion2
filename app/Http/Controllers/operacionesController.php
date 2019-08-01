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

      foreach($categorias as $key=>$categoria){
         foreach($categoria->subcategorias->sortBy('nombre') as $subcategoria){
          $subcategoriasAgrupadas[$categoria->nombre][$subcategoria->id] = $subcategoria->nombre;
        }
      }

        return view('operaciones.create')->with(compact('empresas','cuental','proveedores','subcategoriasAgrupadas','metpago'));
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

        $operaciones = $this->operacionesRepository->create($input);

        Flash::success('Operaciones guardado correctamente.');
        Alert::success('Operaciones guardado correctamente.');

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
            Flash::error('Operaciones no encontrado');
            Alert::error('Operaciones no encontrado.');

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
        return view('operaciones.edit')->with(compact('operaciones','empresas', 'cuental', 'proveedores','subcategoriasAgrupadas','metpago'));
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
            Flash::error('Operaciones no encontrado');
            Alert::error('Operaciones no encontrado');

            return redirect(route('operaciones.index'));
        }

        $operaciones = $this->operacionesRepository->update($request->all(), $id);

        Flash::success('Operaciones actualizado correctamente.');
        Alert::success('Operaciones actualizado correctamente.');

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
            Flash::error('Operaciones no encontrado');
            Alert::error('Operaciones no encontrado');

            return redirect(route('operaciones.index'));
        }

        $this->operacionesRepository->delete($id);

        Flash::success('Operaciones borrado correctamente.');
        Alert::success('Operaciones borrado correctamente.');

        return redirect(route('operaciones.index'));
    }
}

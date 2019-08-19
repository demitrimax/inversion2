<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatetareasRequest;
use App\Http\Requests\UpdatetareasRequest;
use App\Repositories\tareasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\User;
use App\Models\tareavances;
use App\Models\tareas;
use Auth;

class tareasController extends AppBaseController
{
    /** @var  tareasRepository */
    private $tareasRepository;

    public function __construct(tareasRepository $tareasRepo)
    {
        $this->tareasRepository = $tareasRepo;
        $this->middleware('permission:tareas-list');
        $this->middleware('permission:tareas-mostrar');
        $this->middleware('permission:tareas-show', ['only' => ['show']]);
        $this->middleware('permission:tareas-create', ['only' => ['create','store']]);
        $this->middleware('permission:tareas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tareas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the tareas.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->tareasRepository->pushCriteria(new RequestCriteria($request));
        $tareas = $this->tareasRepository->orderBy('vencimiento','asc')->get();
        $tareas = tareas::whereNull('terminado')->orderBy('vencimiento', 'asc')->get();

        return view('tareas.index')
            ->with('tareas', $tareas);
    }

    public function todasindex(Request $request)
    {
        $this->tareasRepository->pushCriteria(new RequestCriteria($request));
        $tareas = $this->tareasRepository->orderBy('vencimiento','asc')->get();

        return view('tareas.index')
            ->with('tareas', $tareas);
    }

    /**
     * Show the form for creating a new tareas.
     *
     * @return Response
     */
    public function create()
    {
        $usuarios = User::pluck('name','id');
        return view('tareas.create')->with(compact('usuarios'));
    }

    /**
     * Store a newly created tareas in storage.
     *
     * @param CreatetareasRequest $request
     *
     * @return Response
     */
    public function store(CreatetareasRequest $request)
    {
        $input = $request->all();

        $tareas = $this->tareasRepository->create($input);

        Flash::success('Tarea guardada correctamente.');
        Alert::success('Tarea guardada correctamente.');

        return redirect(route('tareas.index'));
    }

    /**
     * Display the specified tareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $tareas = $this->tareasRepository->findWithoutFail($id);

        if (empty($tareas)) {
            Flash::error('Tarea no encontrada');
            Alert::error('Tarea no encontrada.');

            return redirect(route('tareas.index'));
        }
        if($tareas->user_id == Auth::user()->id){
          //si el usuario asignado vió los detalles de la tarea guardar el registro
          if(empty($tareas->viewed_at)){
            $tareas->viewed_at = Date('Y-m-d h:i:s');
            $tareas->avance_porc = 10;
            $tareas->save();
          }
          if($tareas->avance_porc == 100){
            if(empty($tareas->terminado)){
              $tareas->terminado = date('Y-m-d H:i:s');
              $tareas->save();
            }

          }
        }

        return view('tareas.show')->with('tareas', $tareas);
    }

    /**
     * Show the form for editing the specified tareas.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $tareas = $this->tareasRepository->findWithoutFail($id);

        if (empty($tareas)) {
            Flash::error('Tarea no encontrada');
            Alert::error('Tarea no encontrada');

            return redirect(route('tareas.index'));
        }
        $usuarios = User::pluck('name','id');
        return view('tareas.edit')->with(compact('tareas', 'usuarios'));
    }

    /**
     * Update the specified tareas in storage.
     *
     * @param  int              $id
     * @param UpdatetareasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatetareasRequest $request)
    {
        $tareas = $this->tareasRepository->findWithoutFail($id);

        if (empty($tareas)) {
            Flash::error('Tarea no encontrada');
            Alert::error('Tarea no encontrada');

            return redirect(route('tareas.index'));
        }

        $tareas = $this->tareasRepository->update($request->all(), $id);

        Flash::success('Tarea actualizada correctamente.');
        Alert::success('Tarea actualizada correctamente.');

        return redirect(route('tareas.index'));
    }

    /**
     * Remove the specified tareas from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $tareas = $this->tareasRepository->findWithoutFail($id);

        if (empty($tareas)) {
            Flash::error('Tarea no encontrada');
            Alert::error('Tarea no encontrada');

            return redirect(route('tareas.index'));
        }

        $this->tareasRepository->delete($id);

        Flash::success('Tarea borrada correctamente.');
        Alert::success('Tarea borrada correctamente.');

        return redirect(route('tareas.index'));
    }
    public function registroavance(Request $request)
    {
      $input = $request->all();

      $avance = new tareavances;
      $avance->concepto = $input['concepto'];
      $avance->comentario = $input['comentario'];
      $avance->avancepor = $input['avancepor'];
      $avance->tarea_id = $input['tarea_id'];
      $avance->save();

      $tarea = tareas::find($input['tarea_id']);
      $tarea->avance_porc = $input['avancepor'];
      if($input['avancepor'] == 100){
        $tarea->terminado = date('Y-m-d H:i:s');
      }
      $tarea->save();

      Flash::success('se ha registrado avance correctamente');
      Alert::success('se ha registrado avance correctamente.');

      return back();


    }
}

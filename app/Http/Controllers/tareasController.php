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

class tareasController extends AppBaseController
{
    /** @var  tareasRepository */
    private $tareasRepository;

    public function __construct(tareasRepository $tareasRepo)
    {
        $this->tareasRepository = $tareasRepo;
        $this->middleware('permission:tareas-list');
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
        $tareas = $this->tareasRepository->all();

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
}

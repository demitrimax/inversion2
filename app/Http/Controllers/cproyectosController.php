<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecproyectosRequest;
use App\Http\Requests\UpdatecproyectosRequest;
use App\Repositories\cproyectosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\clasifica;

class cproyectosController extends AppBaseController
{
    /** @var  cproyectosRepository */
    private $cproyectosRepository;

    public function __construct(cproyectosRepository $cproyectosRepo)
    {
        $this->cproyectosRepository = $cproyectosRepo;
        $this->middleware('permission:cproyectos-list');
        $this->middleware('permission:cproyectos-create', ['only' => ['create','store']]);
        $this->middleware('permission:cproyectos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:cproyectos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the cproyectos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->cproyectosRepository->pushCriteria(new RequestCriteria($request));
        $cproyectos = $this->cproyectosRepository->all();

        return view('cproyectos.index')
            ->with('cproyectos', $cproyectos);
    }

    /**
     * Show the form for creating a new cproyectos.
     *
     * @return Response
     */
    public function create()
    {
        $clasificacion = clasifica::pluck('nombre','id');
        return view('cproyectos.create')->with(compact('clasificacion'));
    }

    /**
     * Store a newly created cproyectos in storage.
     *
     * @param CreatecproyectosRequest $request
     *
     * @return Response
     */
    public function store(CreatecproyectosRequest $request)
    {
        $input = $request->all();

        $cproyectos = $this->cproyectosRepository->create($input);

        Flash::success('Proyecto guardado correctamente.');
        Alert::success('Proyecto guardado correctamente.');

        return redirect(route('cproyectos.index'));
    }

    /**
     * Display the specified cproyectos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cproyectos = $this->cproyectosRepository->findWithoutFail($id);

        if (empty($cproyectos)) {
            Flash::error('Proyecto no encontrado');
            Alert::error('Proyecto no encontrado.');

            return redirect(route('cproyectos.index'));
        }

        return view('cproyectos.show')->with('cproyectos', $cproyectos);
    }

    /**
     * Show the form for editing the specified cproyectos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $cproyectos = $this->cproyectosRepository->findWithoutFail($id);

        if (empty($cproyectos)) {
            Flash::error('Proyecto no encontrado');
            Alert::error('Proyecto no encontrado');

            return redirect(route('cproyectos.index'));
        }
        $clasificacion = clasifica::pluck('nombre','id');
        return view('cproyectos.edit')->with(compact('cproyectos','clasificacion'));
    }

    /**
     * Update the specified cproyectos in storage.
     *
     * @param  int              $id
     * @param UpdatecproyectosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecproyectosRequest $request)
    {
        $cproyectos = $this->cproyectosRepository->findWithoutFail($id);

        if (empty($cproyectos)) {
            Flash::error('Proyecto no encontrado');
            Alert::error('Proyecto no encontrado');

            return redirect(route('cproyectos.index'));
        }

        $cproyectos = $this->cproyectosRepository->update($request->all(), $id);

        Flash::success('Proyecto actualizado correctamente.');
        Alert::success('Proyecto actualizado correctamente.');

        return redirect(route('cproyectos.index'));
    }

    /**
     * Remove the specified cproyectos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cproyectos = $this->cproyectosRepository->findWithoutFail($id);

        if (empty($cproyectos)) {
            Flash::error('Proyecto no encontrado');
            Alert::error('Proyecto no encontrado');

            return redirect(route('cproyectos.index'));
        }

        $this->cproyectosRepository->delete($id);

        Flash::success('Proyecto borrado correctamente.');
        Flash::success('Proyecto borrado correctamente.');

        return redirect(route('cproyectos.index'));
    }
}

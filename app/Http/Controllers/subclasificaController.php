<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesubclasificaRequest;
use App\Http\Requests\UpdatesubclasificaRequest;
use App\Repositories\subclasificaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\clasifica;

class subclasificaController extends AppBaseController
{
    /** @var  subclasificaRepository */
    private $subclasificaRepository;

    public function __construct(subclasificaRepository $subclasificaRepo)
    {
        $this->subclasificaRepository = $subclasificaRepo;
        $this->middleware('permission:subclasificas-list');
        $this->middleware('permission:subclasificas-create', ['only' => ['create','store']]);
        $this->middleware('permission:subclasificas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subclasificas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the subclasifica.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->subclasificaRepository->pushCriteria(new RequestCriteria($request));
        $subclasificas = $this->subclasificaRepository->all();

        return view('subclasificas.index')
            ->with('subclasificas', $subclasificas);
    }

    /**
     * Show the form for creating a new subclasifica.
     *
     * @return Response
     */
    public function create()
    {
        $categorias = clasifica::pluck('nombre','id');
        return view('subclasificas.create')->with(compact('categorias'));
    }

    /**
     * Store a newly created subclasifica in storage.
     *
     * @param CreatesubclasificaRequest $request
     *
     * @return Response
     */
    public function store(CreatesubclasificaRequest $request)
    {
        $input = $request->all();

        $subclasifica = $this->subclasificaRepository->create($input);

        Flash::success('Subcategoría guardada correctamente.');
        Alert::success('Subcategoría guardado correctamente.');

        return redirect(route('subclasificas.index'));
    }

    /**
     * Display the specified subclasifica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $subclasifica = $this->subclasificaRepository->findWithoutFail($id);

        if (empty($subclasifica)) {
            Flash::error('Subcategoría no encontrada');
            Alert::error('Subcategoría no encontrada.');

            return redirect(route('subclasificas.index'));
        }

        return view('subclasificas.show')->with('subclasifica', $subclasifica);
    }

    /**
     * Show the form for editing the specified subclasifica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $subclasifica = $this->subclasificaRepository->findWithoutFail($id);

        if (empty($subclasifica)) {
            Flash::error('Subcategoría no encontrada');
            Alert::error('Subcategoría no encontrada');

            return redirect(route('subclasificas.index'));
        }
        $categorias = clasifica::pluck('nombre','id');
        return view('subclasificas.edit')->with(compact('subclasifica','categorias'));
    }

    /**
     * Update the specified subclasifica in storage.
     *
     * @param  int              $id
     * @param UpdatesubclasificaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesubclasificaRequest $request)
    {
        $subclasifica = $this->subclasificaRepository->findWithoutFail($id);

        if (empty($subclasifica)) {
            Flash::error('Subcategoría no encontrada');
            Alert::error('Subcategoría no encontrada');

            return redirect(route('subclasificas.index'));
        }

        $subclasifica = $this->subclasificaRepository->update($request->all(), $id);

        Flash::success('Subcategoría actualizada correctamente.');
        Alert::success('Subcategoría actualizada correctamente.');

        return redirect(route('subclasificas.index'));
    }

    /**
     * Remove the specified subclasifica from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $subclasifica = $this->subclasificaRepository->findWithoutFail($id);

        if (empty($subclasifica)) {
            Flash::error('Subcategoría no encontrada');
            Alert::error('Subcategoría no encontrada');

            return redirect(route('subclasificas.index'));
        }

        if($subclasifica->operaciones->count()>0){
          Flash::error('No se puede eliminar la SubCategoría, tiene asignada operaciones.');
          Alert::error('No se puede eliminar la SubCategoría, tiene asignada operaciones.');

          return redirect(route('subclasificas.index'));
        }

        $this->subclasificaRepository->delete($id);

        Flash::success('Subcategoría borrada correctamente.');
        Alert::success('Subcategoría borrada correctamente.');

        return redirect(route('subclasificas.index'));
    }
}

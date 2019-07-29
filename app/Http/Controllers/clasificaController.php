<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateclasificaRequest;
use App\Http\Requests\UpdateclasificaRequest;
use App\Repositories\clasificaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class clasificaController extends AppBaseController
{
    /** @var  clasificaRepository */
    private $clasificaRepository;

    public function __construct(clasificaRepository $clasificaRepo)
    {
        $this->clasificaRepository = $clasificaRepo;
        $this->middleware('permission:clasificas-list');
        $this->middleware('permission:clasificas-create', ['only' => ['create','store']]);
        $this->middleware('permission:clasificas-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:clasificas-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the clasifica.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->clasificaRepository->pushCriteria(new RequestCriteria($request));
        $clasificas = $this->clasificaRepository->all();

        return view('clasificas.index')
            ->with('clasificas', $clasificas);
    }

    /**
     * Show the form for creating a new clasifica.
     *
     * @return Response
     */
    public function create()
    {
        return view('clasificas.create');
    }

    /**
     * Store a newly created clasifica in storage.
     *
     * @param CreateclasificaRequest $request
     *
     * @return Response
     */
    public function store(CreateclasificaRequest $request)
    {
        $input = $request->all();

        $clasifica = $this->clasificaRepository->create($input);

        Flash::success('Categoría guardada correctamente.');
        Alert::success('Categoría guardada correctamente.');

        return redirect(route('clasificas.index'));
    }

    /**
     * Display the specified clasifica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $clasifica = $this->clasificaRepository->findWithoutFail($id);

        if (empty($clasifica)) {
            Flash::error('Categoría no encontrada');
            Alert::error('Categoría no encontrada.');

            return redirect(route('clasificas.index'));
        }

        return view('clasificas.show')->with('clasifica', $clasifica);
    }

    /**
     * Show the form for editing the specified clasifica.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $clasifica = $this->clasificaRepository->findWithoutFail($id);

        if (empty($clasifica)) {
            Flash::error('Categoría no encontrada');
            Alert::error('Categoría no encontrada');

            return redirect(route('clasificas.index'));
        }

        return view('clasificas.edit')->with('clasifica', $clasifica);
    }

    /**
     * Update the specified clasifica in storage.
     *
     * @param  int              $id
     * @param UpdateclasificaRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateclasificaRequest $request)
    {
        $clasifica = $this->clasificaRepository->findWithoutFail($id);

        if (empty($clasifica)) {
            Flash::error('Categoría no encontrada');
            Alert::error('Categoría no encontrada');

            return redirect(route('clasificas.index'));
        }

        $clasifica = $this->clasificaRepository->update($request->all(), $id);

        Flash::success('Categoría actualizada correctamente.');
        Alert::success('Categoría actualizada correctamente.');

        return redirect(route('clasificas.index'));
    }

    /**
     * Remove the specified clasifica from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $clasifica = $this->clasificaRepository->findWithoutFail($id);

        if (empty($clasifica)) {
            Flash::error('Categoría no encontrada');
            Alert::error('Categoría no encontrada');

            return redirect(route('clasificas.index'));
        }
        if($clasifica->subcategorias->count()>0){
          Flash::error('Categoría no se puede elminar, tiene subcategorías.');
          Alert::error('Categoría no se puede elminar, tiene subcategorías.');

            return redirect(route('clasificas.index'));
        }

        $this->clasificaRepository->delete($id);

        Flash::success('Categoría borrada correctamente.');
        Alert::success('Categoría borrada correctamente.');

        return redirect(route('clasificas.index'));
    }
}

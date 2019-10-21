<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateminventarioRequest;
use App\Http\Requests\UpdateminventarioRequest;
use App\Repositories\minventarioRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class minventarioController extends AppBaseController
{
    /** @var  minventarioRepository */
    private $minventarioRepository;

    public function __construct(minventarioRepository $minventarioRepo)
    {
        $this->minventarioRepository = $minventarioRepo;
        $this->middleware('permission:minventarios-list');
        $this->middleware('permission:minventarios-create', ['only' => ['create','store']]);
        $this->middleware('permission:minventarios-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:minventarios-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the minventario.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->minventarioRepository->pushCriteria(new RequestCriteria($request));
        $minventarios = $this->minventarioRepository->all();

        return view('minventarios.index')
            ->with('minventarios', $minventarios);
    }

    /**
     * Show the form for creating a new minventario.
     *
     * @return Response
     */
    public function create()
    {
        return view('minventarios.create');
    }

    /**
     * Store a newly created minventario in storage.
     *
     * @param CreateminventarioRequest $request
     *
     * @return Response
     */
    public function store(CreateminventarioRequest $request)
    {
        $input = $request->all();

        $minventario = $this->minventarioRepository->create($input);

        Flash::success('Minventario guardado correctamente.');
        Alert::success('Minventario guardado correctamente.');

        return redirect(route('minventarios.index'));
    }

    /**
     * Display the specified minventario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $minventario = $this->minventarioRepository->findWithoutFail($id);

        if (empty($minventario)) {
            Flash::error('Minventario no encontrado');
            Alert::error('Minventario no encontrado.');

            return redirect(route('minventarios.index'));
        }

        return view('minventarios.show')->with('minventario', $minventario);
    }

    /**
     * Show the form for editing the specified minventario.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $minventario = $this->minventarioRepository->findWithoutFail($id);

        if (empty($minventario)) {
            Flash::error('Minventario no encontrado');
            Alert::error('Minventario no encontrado');

            return redirect(route('minventarios.index'));
        }

        return view('minventarios.edit')->with('minventario', $minventario);
    }

    /**
     * Update the specified minventario in storage.
     *
     * @param  int              $id
     * @param UpdateminventarioRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateminventarioRequest $request)
    {
        $minventario = $this->minventarioRepository->findWithoutFail($id);

        if (empty($minventario)) {
            Flash::error('Minventario no encontrado');
            Alert::error('Minventario no encontrado');

            return redirect(route('minventarios.index'));
        }

        $minventario = $this->minventarioRepository->update($request->all(), $id);

        Flash::success('Minventario actualizado correctamente.');
        Alert::success('Minventario actualizado correctamente.');

        return redirect(route('minventarios.index'));
    }

    /**
     * Remove the specified minventario from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $minventario = $this->minventarioRepository->findWithoutFail($id);

        if (empty($minventario)) {
            Flash::error('Minventario no encontrado');
            Alert::error('Minventario no encontrado');

            return redirect(route('minventarios.index'));
        }

        $this->minventarioRepository->delete($id);

        Flash::success('Minventario borrado correctamente.');
        Flash::success('Minventario borrado correctamente.');

        return redirect(route('minventarios.index'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatecategoriasRequest;
use App\Http\Requests\UpdatecategoriasRequest;
use App\Repositories\categoriasRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class categoriasController extends AppBaseController
{
    /** @var  categoriasRepository */
    private $categoriasRepository;

    public function __construct(categoriasRepository $categoriasRepo)
    {
        $this->categoriasRepository = $categoriasRepo;
        $this->middleware('permission:categorias-list');
        $this->middleware('permission:categorias-create', ['only' => ['create','store']]);
        $this->middleware('permission:categorias-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:categorias-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the categorias.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->categoriasRepository->pushCriteria(new RequestCriteria($request));
        $categorias = $this->categoriasRepository->all();

        return view('categorias.index')
            ->with('categorias', $categorias);
    }

    /**
     * Show the form for creating a new categorias.
     *
     * @return Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created categorias in storage.
     *
     * @param CreatecategoriasRequest $request
     *
     * @return Response
     */
    public function store(CreatecategoriasRequest $request)
    {
        $input = $request->all();

        $categorias = $this->categoriasRepository->create($input);

        Flash::success('Categorias guardado correctamente.');
        Alert::success('Categorias guardado correctamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Display the specified categorias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categorias no encontrado');
            Alert::error('Categorias no encontrado.');

            return redirect(route('categorias.index'));
        }

        return view('categorias.show')->with('categorias', $categorias);
    }

    /**
     * Show the form for editing the specified categorias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categorias no encontrado');
            Alert::error('Categorias no encontrado');

            return redirect(route('categorias.index'));
        }

        return view('categorias.edit')->with('categorias', $categorias);
    }

    /**
     * Update the specified categorias in storage.
     *
     * @param  int              $id
     * @param UpdatecategoriasRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatecategoriasRequest $request)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categorias no encontrado');
            Alert::error('Categorias no encontrado');

            return redirect(route('categorias.index'));
        }

        $categorias = $this->categoriasRepository->update($request->all(), $id);

        Flash::success('Categorias actualizado correctamente.');
        Alert::success('Categorias actualizado correctamente.');

        return redirect(route('categorias.index'));
    }

    /**
     * Remove the specified categorias from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $categorias = $this->categoriasRepository->findWithoutFail($id);

        if (empty($categorias)) {
            Flash::error('Categorias no encontrado');
            Alert::error('Categorias no encontrado');

            return redirect(route('categorias.index'));
        }

        if ($categorias->productos->count()>0) {
            Flash::error('No se puede eliminar la categoria, hay productos registrados con esta.');
            Alert::error('No se puede eliminar la categoria, hay productos registrados con esta.');

            return redirect(route('categorias.index'));
        }

        $this->categoriasRepository->delete($id);

        Flash::success('Categorias borrado correctamente.');
        Flash::success('Categorias borrado correctamente.');

        return redirect(route('categorias.index'));
    }
}

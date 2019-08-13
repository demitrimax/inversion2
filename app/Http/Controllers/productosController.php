<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproductosRequest;
use App\Http\Requests\UpdateproductosRequest;
use App\Repositories\productosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\categorias;

class productosController extends AppBaseController
{
    /** @var  productosRepository */
    private $productosRepository;

    public function __construct(productosRepository $productosRepo)
    {
        $this->productosRepository = $productosRepo;
        $this->middleware('permission:productos-list');
        $this->middleware('permission:productos-create', ['only' => ['create','store']]);
        $this->middleware('permission:productos-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:productos-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the productos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productosRepository->pushCriteria(new RequestCriteria($request));
        $productos = $this->productosRepository->all();

        return view('productos.index')
            ->with('productos', $productos);
    }

    /**
     * Show the form for creating a new productos.
     *
     * @return Response
     */
    public function create()
    {
      $categorias = categorias::pluck('nombre','id');
        return view('productos.create')->with(compact('categorias'));
    }

    /**
     * Store a newly created productos in storage.
     *
     * @param CreateproductosRequest $request
     *
     * @return Response
     */
    public function store(CreateproductosRequest $request)
    {
        $input = $request->all();

        $productos = $this->productosRepository->create($input);

        Flash::success('Productos guardado correctamente.');
        Alert::success('Productos guardado correctamente.');

        return redirect(route('productos.index'));
    }

    /**
     * Display the specified productos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productos = $this->productosRepository->findWithoutFail($id);

        if (empty($productos)) {
            Flash::error('Productos no encontrado');
            Alert::error('Productos no encontrado.');

            return redirect(route('productos.index'));
        }

        return view('productos.show')->with('productos', $productos);
    }

    /**
     * Show the form for editing the specified productos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productos = $this->productosRepository->findWithoutFail($id);

        if (empty($productos)) {
            Flash::error('Productos no encontrado');
            Alert::error('Productos no encontrado');

            return redirect(route('productos.index'));
        }
        $categorias = categorias::pluck('nombre','id');
        return view('productos.edit')->with(compact('productos','categorias'));
    }

    /**
     * Update the specified productos in storage.
     *
     * @param  int              $id
     * @param UpdateproductosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproductosRequest $request)
    {
        $productos = $this->productosRepository->findWithoutFail($id);

        if (empty($productos)) {
            Flash::error('Producto no encontrado');
            Alert::error('Producto no encontrado');

            return redirect(route('productos.index'));
        }

        $productos = $this->productosRepository->update($request->all(), $id);

        Flash::success('Producto actualizado correctamente.');
        Alert::success('Producto actualizado correctamente.');

        return redirect(route('productos.index'));
    }

    /**
     * Remove the specified productos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $productos = $this->productosRepository->findWithoutFail($id);

        if (empty($productos)) {
            Flash::error('Productos no encontrado');
            Alert::error('Productos no encontrado');

            return back();
        }
        if($productos->stock > 0){
          Flash::error('Producto con Stock, por lo que no se puede eliminar.');
          Alert::error('Producto con Stock, por lo que no se puede eliminar.');

          return back();
        }
        if($productos->inventarios->count() > 0){
          Flash::error('Producto con movimiento en inventarios, no se puede eliminar.');
          Alert::error('Producto con movimiento en inventarios, no se puede eliminar.');

          return back();
        }

        $this->productosRepository->delete($id);

        Flash::success('Producto borrado correctamente.');
        Alert::success('Producto borrado correctamente.');

        return redirect(route('productos.index'));
    }
}

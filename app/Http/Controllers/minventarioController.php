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
use Illuminate\Support\Facades\Storage;
use App\Models\operaciones;
use App\Models\minventario;

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

        Flash::success('Articulo/Producto guardado correctamente.');
        Alert::success('Articulo/Producto guardado correctamente.');

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
            Flash::error('Articulo/Producto no encontrado');
            Alert::error('Articulo/Producto no encontrado.');

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
            Flash::error('Articulo/Producto no encontrado');
            Alert::error('Articulo/Producto no encontrado');

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
        $input = $request->all();

        if (empty($minventario)) {
            Flash::error('Articulo/Producto no encontrado');
            Alert::error('Articulo/Producto no encontrado');

            return redirect(route('minventarios.index'));
        }

        $minventario = $this->minventarioRepository->update($request->all(), $id);

        if( isset($input['fileresguardo']) ){
                    //$documento->nombre_doc = $request->file('documento')->store('documentos');
          $archivo = $request->file('fileresguardo')->store('resguardos');

          $minventario->fileresguardo = $archivo;
          $minventario->save();
        }

        Flash::success('Articulo/Producto actualizado correctamente.');
        Alert::success('Articulo/Producto actualizado correctamente.');

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
            Flash::error('Mi Inventario no encontrado');
            Alert::error('Mi Inventario no encontrado');

            return redirect(route('minventarios.index'));
        }

        $this->minventarioRepository->delete($id);

        Flash::success('Articulo/Producto borrado correctamente.');
        Alert::success('Articulo/Producto borrado correctamente.');

        return redirect(route('minventarios.index'));
    }

    public function viewPDF($id)
    {
      $resguardo = $this->minventarioRepository->findWithoutFail($id);

      if (empty($resguardo)) {

          return "Documento no encontrado";
      }

      //return Storage::download($documentos->documento,$nomarchivo);

      //return Storage::get($documentos->documento,$nomarchivo);
      $mimetype = Storage::mimeType($resguardo->fileresguardo);

      $path = storage_path('app/'.$resguardo->fileresguardo);
      //return response()->download($path);
      if ($mimetype == 'application/pdf' || $mimetype == 'image/*'){
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => $mimetype,
            'Content-Disposition' => 'inline; filename="resguardo"'
        ]);
      }
      else {
        return Storage::download($resguardo->fileresguardo);
      }

    }

    public function agregarproducto($id, Request $request)
    {
      $operacion = operaciones::find($id);
      if(empty($operacion)) {
        $mensaje = 'No se encontró la operación.';
        Alert::error($mensaje);
        Flash::error($mensaje);
        return back();
      }

      $input = $request->all();

      $opInventario = new minventario;
      $opInventario->concepto = $input['concepto_2'];
      $opInventario->marca = $input['marca_2'];
      $opInventario->modelo = $input['modelo_2'];
      $opInventario->codigo = $input['codigo_2'];
      $opInventario->montocompra = $input['monto_2'];
      $opInventario->operacion_id = $operacion->id;
      $opInventario->save();

      $mensaje = 'Articulo/Producto agregado correctamente';
      Alert::success($mensaje);
      Flash::success($mensaje);


      return back();
    }
}

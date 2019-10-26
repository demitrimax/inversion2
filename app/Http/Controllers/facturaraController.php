<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefacturaraRequest;
use App\Http\Requests\UpdatefacturaraRequest;
use App\Repositories\facturaraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Storage;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Helper\Sample;

use \ConvertApi\ConvertApi;

class facturaraController extends AppBaseController
{
    /** @var  facturaraRepository */
    private $facturaraRepository;

    public function __construct(facturaraRepository $facturaraRepo)
    {
        $this->facturaraRepository = $facturaraRepo;
        $this->middleware('permission:facturaras-list');
        $this->middleware('permission:facturaras-create', ['only' => ['create','store']]);
        $this->middleware('permission:facturaras-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:facturaras-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the facturara.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->facturaraRepository->pushCriteria(new RequestCriteria($request));
        $facturaras = $this->facturaraRepository->all();

        return view('facturaras.index')
            ->with('facturaras', $facturaras);
    }

    /**
     * Show the form for creating a new facturara.
     *
     * @return Response
     */
    public function create()
    {
        return view('facturaras.create');
    }

    /**
     * Store a newly created facturara in storage.
     *
     * @param CreatefacturaraRequest $request
     *
     * @return Response
     */
    public function store(CreatefacturaraRequest $request)
    {
        $input = $request->all();

        $facturara = $this->facturaraRepository->create($input);

        Flash::success('Empresa a Facturar guardado correctamente.');
        Alert::success('Empresa a Facturar guardado correctamente.');

        return redirect(route('facturaras.index'));
    }

    /**
     * Display the specified facturara.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado.');

            return redirect(route('facturaras.index'));
        }

        $nombrefile = $facturara->plantilla_excel;
        $laimagen = null;

        if($nombrefile) {
          if(!strpos($nombrefile, '.xlsx') == false){
              $eljpg = str_replace('.xlsx', '.jpg', $nombrefile);
              $miext = 'xlsx';
          }elseif(!strpos($nombrefile, '.xls') == false){
            $eljpg = str_replace('.xls', '.jpg', $nombrefile);
            $miext = 'xls';
          }

          $existsXLS = Storage::disk('public')->exists($facturara->plantilla_excel);
          $existsJPG = Storage::disk('public')->exists($eljpg);
          if($existsJPG == false ) {

              $visibility = Storage::disk('public')->path($nombrefile);
              $laruta = Storage::disk('public')->path('plantilla_empresas');
              //dd($laruta);

            ConvertApi::setApiSecret('ZcV8UF0LolTg1nda');
              $result = ConvertApi::convert('jpg', [
                'File' => $visibility,
              ], $miext
                );
                $result->saveFiles($laruta);

              }elseif($existsJPG){
                $laimagen = Storage::disk('public')->url($eljpg);
                //dd($laimagen);
              }
        }





          /*
          $reader = IOFactory::createReader('Xlsx');

          $visibility = Storage::disk('public')->path($nombrefile);
          //dd($visibility);

          $spreadsheet = $reader->load($visibility);
          $spreadsheet->getProperties()->setCreator('pi.corporation-tym.mx')
              ->setLastModifiedBy('pi.corporation-tym.mx')
              ->setTitle('Plantilla REMISION')
              ->setSubject('Plantilla REMISION')
              ->setDescription('Formato de REMISION')
              ->setKeywords('proyectos de Inversion')
              ->setCategory('REMISION');
          $spreadsheet->getActiveSheet()->setTitle('FORMATO');
          $className = \PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf::class;

          $helper = new Sample();
          $helper->log("Write to PDF format using {$className}");
          IOFactory::registerWriter('Pdf', $className);

          // Save
          $helper->write($spreadsheet, $visibility, ['Pdf']);

        }
        */

        return view('facturaras.show')->with(compact('facturara','laimagen'));
    }

    /**
     * Show the form for editing the specified facturara.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }
        $nombrefile = $facturara->plantilla_excel;
        $eljpg = $this->existeElJpg($nombrefile);
        $laimagen = null;
        if ($eljpg) {
          $laimagen = Storage::disk('public')->url($eljpg);
        }


        return view('facturaras.edit')->with(compact('facturara','laimagen'));
    }

    /**
     * Update the specified facturara in storage.
     *
     * @param  int              $id
     * @param UpdatefacturaraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefacturaraRequest $request)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);
        $input = $request->all();

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }

        $facturara = $this->facturaraRepository->update($request->all(), $id);

        if( isset($input['plantilla_excel']) ){
                    //$documento->nombre_doc = $request->file('documento')->store('documentos');
          $archivo = $request->file('plantilla_excel')->store('plantilla_empresas', 'public');
          //$archivo = Storage::putFile(public_path().'plantilla_empresas/', $input['plantilla_excel']);

          $facturara->plantilla_excel = $archivo;
          $facturara->save();

          //convertir el archivo de excel en PDF

        }


        Flash::success('Facturara actualizado correctamente.');
        Alert::success('Facturara actualizado correctamente.');

        return redirect(route('facturaras.index'));
    }

    /**
     * Remove the specified facturara from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $facturara = $this->facturaraRepository->findWithoutFail($id);

        if (empty($facturara)) {
            Flash::error('Facturara no encontrado');
            Alert::error('Facturara no encontrado');

            return redirect(route('facturaras.index'));
        }

        $this->facturaraRepository->delete($id);

        Flash::success('Facturara borrado correctamente.');
        Flash::success('Facturara borrado correctamente.');

        return redirect(route('facturaras.index'));
    }

    public function existeElJpg($nombrefile)
    {
      if($nombrefile) {
        if(!strpos($nombrefile, '.xlsx') == false){
            $eljpg = str_replace('.xlsx', '.jpg', $nombrefile);
            $miext = 'xlsx';
        }elseif(!strpos($nombrefile, '.xls') == false){
          $eljpg = str_replace('.xls', '.jpg', $nombrefile);
          $miext = 'xls';
        }

        if (Storage::disk('public')->exists($eljpg)){
          return $eljpg;
        }

      }
      return false;
    }
}

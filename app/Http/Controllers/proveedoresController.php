<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateproveedoresRequest;
use App\Http\Requests\UpdateproveedoresRequest;
use App\Repositories\proveedoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\operaciones;
use App\Models\proveedores;

use Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Helper\Html as HtmlHelper;

class proveedoresController extends AppBaseController
{
    /** @var  proveedoresRepository */
    private $proveedoresRepository;

    public function __construct(proveedoresRepository $proveedoresRepo)
    {
        $this->proveedoresRepository = $proveedoresRepo;
        $this->middleware('permission:proveedores-list');
        $this->middleware('permission:proveedores-create', ['only' => ['create','store']]);
        $this->middleware('permission:proveedores-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:proveedores-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the proveedores.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->proveedoresRepository->pushCriteria(new RequestCriteria($request));
        $proveedores = $this->proveedoresRepository->all();

        return view('proveedores.index')
            ->with('proveedores', $proveedores);
    }

    /**
     * Show the form for creating a new proveedores.
     *
     * @return Response
     */
    public function create()
    {
        return view('proveedores.create');
    }

    /**
     * Store a newly created proveedores in storage.
     *
     * @param CreateproveedoresRequest $request
     *
     * @return Response
     */
    public function store(CreateproveedoresRequest $request)
    {
        $input = $request->all();

        $proveedores = $this->proveedoresRepository->create($input);

        Flash::success('Proveedores guardado correctamente.');
        Alert::success('Proveedores guardado correctamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Display the specified proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado.');

            return redirect(route('proveedores.index'));
        }

        $toperacionesg = operaciones::where('proveedor_id',$id)
                                    ->selectRaw('*, sum(monto) as montog, count(monto) as cantidad, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                    ->groupBy('fechag')
                                    ->orderBy('fechag', 'asc')
                                    ->get();
        $lasoperaciones = operaciones::where('proveedor_id',$id)
                                    ->selectRaw('*, DATE_FORMAT(fecha, "%m-%y") as fechag')
                                    ->orderBy('fechag', 'asc')
                                    ->get();

        return view('proveedores.show')->with(compact('proveedores', 'toperacionesg', 'lasoperaciones'));
    }

    /**
     * Show the form for editing the specified proveedores.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }

        return view('proveedores.edit')->with('proveedores', $proveedores);
    }

    /**
     * Update the specified proveedores in storage.
     *
     * @param  int              $id
     * @param UpdateproveedoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateproveedoresRequest $request)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }

        $proveedores = $this->proveedoresRepository->update($request->all(), $id);

        Flash::success('Proveedores actualizado correctamente.');
        Alert::success('Proveedores actualizado correctamente.');

        return redirect(route('proveedores.index'));
    }

    /**
     * Remove the specified proveedores from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proveedores = $this->proveedoresRepository->findWithoutFail($id);

        if (empty($proveedores)) {
            Flash::error('Proveedores no encontrado');
            Alert::error('Proveedores no encontrado');

            return redirect(route('proveedores.index'));
        }
        //Antes de Eliminar Verificar que no tenga operaciones registradas con ese proveedor
        if($proveedores->operaciones->count()>0)
        {
          Flash::error('No se puede eliminar, el proveedor tiene operaciones asignadas.');
          Alert::error('No se puede eliminar, el proveedor tiene operaciones asignadas.');

          return redirect(route('proveedores.index'));
        }

        $this->proveedoresRepository->delete($id);

        Flash::success('Proveedores borrado correctamente.');
        Flash::success('Proveedores borrado correctamente.');

        return redirect(route('proveedores.index'));
    }
    public function repExcel(Request $request )
    {
      $input = $request->all();

      $findstring = ":";
      $pos = strpos($input['daterange'],$findstring);
      $finicio = substr($input['daterange'], 0, 10);
      $ftermino = substr($input['daterange'], $pos+2, 10);
      $input['finicio'] = date('Y-m-d', strtotime($finicio));
      $input['ftermino'] = date('Y-m-d', strtotime($ftermino));
      $proveedorid = $input['proveedor_id'];

      $proveedor = proveedores::find($proveedorid);
      $opProveedor = operaciones::where('proveedor_id', $proveedorid)
                                         ->whereBetween('fecha', [$input['finicio'], $input['ftermino']])
                                         ->get();

      $archivo = '/plantillaExcel/proveedorx.xlsx';
      $reader = IOFactory::createReader('Xlsx');
      $spreadsheet = $reader->load(public_path($archivo));
      $spreadsheet->getProperties()->setCreator('pi.corporation-tym.mx')
          ->setLastModifiedBy('pi.corporation-tym.mx')
          ->setTitle('Formato Reporte de Operaciones del Proveedor')
          ->setSubject('Formato de Reporte de Operaciones con el Proveedor')
          ->setDescription('Reporte de Operaciones')
          ->setKeywords('REPORTE DE OPERACIONES')
          ->setCategory('REP OPERACIONES');
      $wizard = new HtmlHelper();
      $SheetTitle = 'REPORTE ';
      $spreadsheet->getActiveSheet()->setTitle($SheetTitle);
      $wizard = new HtmlHelper();
      //operaciones
      $enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
      $leyenda = 'Reporte de Proveedor obtenido de '.$enlace_actual.', el día '.date('d-m-Y H:i:s');
      $spreadsheet->getActiveSheet()->setCellValue('A1', $leyenda);
      $nombreProveedor = $proveedor->nombre;
      $spreadsheet->getActiveSheet()->setCellValue('D3', $nombreProveedor);

      $Row = 6;
      foreach($opProveedor as $operacion){
        //2019-01-01 : 2019-12-31
        $vinculo = 'http://'.$_SERVER['HTTP_HOST'].'/operaciones/'.$operacion->id;
        $spreadsheet->getActiveSheet()->setCellValue('A'.$Row, $operacion->id);
        $spreadsheet->getActiveSheet()->setCellValue('B'.$Row, $operacion->tipo);
        $spreadsheet->getActiveSheet()->setCellValue('C'.$Row, $operacion->subclasifica->clasifica->nombre.'/'.$operacion->subclasifica->nombre);
        $spreadsheet->getActiveSheet()->setCellValue('D'.$Row, $operacion->concepto);
        $spreadsheet->getActiveSheet()->setCellValue('E'.$Row, $operacion->monto);
        $spreadsheet->getActiveSheet()->setCellValue('F'.$Row, $operacion->fecha->format('d-m-Y'));

        $spreadsheet->getActiveSheet()->setCellValue('G'.$Row, $vinculo);
        $spreadsheet->getActiveSheet()->getCell('G'.$Row)->getHyperlink()->setUrl($vinculo);

        $Row++;
        $spreadsheet->getActiveSheet()->insertNewRowBefore($Row, 1);
      }
      $RowIni = 6;
      $RowFin = $Row - 1;
      $formula = '=SUM(E'.$RowIni.':E'.$RowFin.')';
      //dd($formula);
      $spreadsheet->getActiveSheet()->setCellValue('E'.$Row, $formula);
      $spreadsheet->getActiveSheet()->getStyle( 'E'.$Row )->getFont()->setBold( true );


      // Redirect output to a client’s web browser (Xlsx)
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment;filename="REPORTE_'.$nombreProveedor.'.xlsx"');
      header('Cache-Control: max-age=0');
      // If you're serving to IE 9, then the following may be needed
      header('Cache-Control: max-age=1');

      // If you're serving to IE over SSL, then the following may be needed
      header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
      header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
      header('Pragma: public'); // HTTP/1.0

      $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
      $writer->save('php://output');
      exit;

    }
}

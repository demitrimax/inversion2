<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateefinancieraRequest;
use App\Http\Requests\UpdateefinancieraRequest;
use App\Repositories\efinancieraRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Alert;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class efinancieraController extends AppBaseController
{
    /** @var  efinancieraRepository */
    private $efinancieraRepository;

    public function __construct(efinancieraRepository $efinancieraRepo)
    {
        $this->efinancieraRepository = $efinancieraRepo;
        $this->middleware('permission:efinancieras-list');
        $this->middleware('permission:efinancieras-create', ['only' => ['create','store']]);
        $this->middleware('permission:efinancieras-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:efinancieras-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the efinanciera.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->efinancieraRepository->pushCriteria(new RequestCriteria($request));
        $efinancieras = $this->efinancieraRepository->all();

        return view('efinancieras.index')
            ->with('efinancieras', $efinancieras);
    }

    /**
     * Show the form for creating a new efinanciera.
     *
     * @return Response
     */
    public function create()
    {
        return view('efinancieras.create');
    }

    /**
     * Store a newly created efinanciera in storage.
     *
     * @param CreateefinancieraRequest $request
     *
     * @return Response
     */
    public function store(CreateefinancieraRequest $request)
    {
        $input = $request->all();

        $efinanciera = $this->efinancieraRepository->create($input);

        Flash::success('Entidad financiera guardada correctamente.');
        Alert::success('Entidad financiera guardada correctamente.');

        return redirect(route('efinancieras.index'));
    }

    /**
     * Display the specified efinanciera.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $efinanciera = $this->efinancieraRepository->findWithoutFail($id);

        if (empty($efinanciera)) {
            Flash::error('Entidad financiera no encontrada');
            Alert::error('Entidad financiera no encontrada.');

            return redirect(route('efinancieras.index'));
        }

        return view('efinancieras.show')->with('efinanciera', $efinanciera);
    }

    /**
     * Show the form for editing the specified efinanciera.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $efinanciera = $this->efinancieraRepository->findWithoutFail($id);

        if (empty($efinanciera)) {
            Flash::error('Entidad financiera no encontrada');
            Alert::error('Entidad financiera no encontrada');

            return redirect(route('efinancieras.index'));
        }

        return view('efinancieras.edit')->with('efinanciera', $efinanciera);
    }

    /**
     * Update the specified efinanciera in storage.
     *
     * @param  int              $id
     * @param UpdateefinancieraRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateefinancieraRequest $request)
    {
        $efinanciera = $this->efinancieraRepository->findWithoutFail($id);

        if (empty($efinanciera)) {
            Flash::error('Entidad financiera no encontrado');
            Alert::error('Entidad financiera no encontrado');

            return redirect(route('efinancieras.index'));
        }

        $efinanciera = $this->efinancieraRepository->update($request->all(), $id);

        Flash::success('Entidad financiera actualizada correctamente.');
        Alert::success('Entidad financiera actualizada correctamente.');

        return redirect(route('efinancieras.index'));
    }

    /**
     * Remove the specified efinanciera from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $efinanciera = $this->efinancieraRepository->findWithoutFail($id);

        if (empty($efinanciera)) {
            Flash::error('Entidad financiera no encontrada');
            Alert::error('Entidad financiera no encontrada');

            return redirect(route('efinancieras.index'));
        }

        $this->efinancieraRepository->delete($id);

        Flash::success('Entidad financiera borrada correctamente.');
        Flash::success('Entidad financiera borrada correctamente.');

        return redirect(route('efinancieras.index'));
    }
}

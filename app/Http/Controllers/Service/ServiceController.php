<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Http\Requests\Service\ServiceFormRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('name', 'asc')->get();
        return view('services.index')->with(compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceFormRequest $request)
    {
        ServiceController::create($request->all());

        return redirect()
            ->route('servicos.index')
            ->with(['success' => 'Serviço cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show')->with(compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit')->with(compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceFormRequest $request, $id)
    {
        $service = Service::find($id);
        $service->fill($request->all());
        $service->save();

        return redirect()
            ->route('servicos.index')
            ->with(['success' => 'Serviço alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::find($id);

        $service->delete();

        \Session::flash('success', 'Serviço ' . $service->name . ' apagado com sucesso.');

        return response()->json(['message' => 'Serviço ' . $service->name . ' apagado com sucesso.']);
    }
}

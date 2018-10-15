<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\Http\Requests\Client\ClientFormRequest;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name', 'asc')->get();
        return view('clients.index')->with(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientFormRequest $request)
    {
        $input = $request->all();

        $input['phone']    = preg_replace('/\D/', '', $request->get('phone'));
        $input['celphone'] = preg_replace('/\D/', '', $request->get('celphone'));
        
        $request->replace($input);

        Client::create($request->all());

        return redirect()
            ->route('clientes.index')
            ->with(['success' => 'Cliente cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.show')->with(compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit')->with(compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientFormRequest $request, $id)
    {
        $input = $request->all();

        $input['phone']    = preg_replace('/\D/', '', $request->get('phone'));
        $input['celphone'] = preg_replace('/\D/', '', $request->get('celphone'));

        $request->replace($input);

        $client = Client::find($id);
        $client->whats = $request->get('whats') == null ? 0 : 1;
        $client->fill($request->all());
        $client->save();

        return redirect()
            ->route('clientes.index')
            ->with(['success' => 'Cliente alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        $client->delete();

        \Session::flash('success', 'Cliente ' . $client->name . ' apagado com sucesso.');

        return response()->json(['message' => 'Cliente ' . $client->name . ' apagado com sucesso.']);
    }
}

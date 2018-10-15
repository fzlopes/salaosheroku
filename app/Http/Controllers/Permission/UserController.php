<?php

namespace App\Http\Controllers\Permission;

use App\Mail\UserActivation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Http\Requests\Permission\PasswordFormRequest;
use App\Http\Requests\Permission\PictureFormRequest;
use App\Http\Requests\Permission\ProfileFormRequest;
use App\Http\Requests\Permission\UserFormRequest;
use App\Http\Requests\Permission\FirstAccessFormRequest;
use App\User;
use App\Role;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', 1)->orderBy('name', 'asc')->get();
        return view('permissions.users.index')->with(compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Role::where('id', '!=', 1)->orderBy('name', 'asc')->get()->pluck('name', 'id');
        return view('permissions.users.create')->with(compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $confirmation_code = str_random(30);

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'activation_code' => $confirmation_code
        ]);

        $user->roles()->attach((array)$request->get('role'));

        Mail::to('quinho@gmail.com')->send(new UserActivation($user));

        return redirect()
            ->route('usuarios.index')
            ->with(['success' => 'Usuário cadastrado com sucesso! Aguardando primeiro acesso.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('permissions.users.show')->with(compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groups = Role::where('id', '!=', 1)->orderBy('name', 'asc')->get()->pluck('name', 'id');
        return view('permissions.users.edit')->with(compact('user', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $user = User::find($id);
        $user->fill($request->only('name', 'email'));
        $user->save();

//        dd($request->get('role', []));

        $user->roles()->sync((array)$request->get('role'));

        return redirect()
            ->route('usuarios.index')
            ->with(['success' => 'Usuário alterado com sucesso!']);
    }

    /**
     * First access
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function firstAccess($token)
    {
        return view('auth.passwords.first-access')->with(compact('token'));

    }

    /**
     * Activate user
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function activateUser(FirstAccessFormRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();

        if (!$user) {
            return redirect()
                ->route('login')
                ->with(['error' => 'Usuário não encontrado']);
        }

        if ($user->activation_code != $request->get('token')) {
            return redirect()
                ->route('login')
                ->with(['error' => 'Usuário não encontrado']);
        }

        $user = User::find($user->id);
        $user->fill($request->only('password'));
        $user->password = bcrypt($user->password);
        $user->first_access = true;
        $user->save();

        return redirect()
            ->route('login')
            ->with(['status' => 'Senha criada!']);

    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blockUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_active = false;
        $user->save();

        \Session::flash('success', 'Usuário '. $user->name . ' bloqueado com sucesso.');

        return response()->json(['message' => 'Usuário '. $user->name . ' bloqueado com sucesso.']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unblockUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->is_active = true;
        $user->save();

        \Session::flash('success', 'Usuário '. $user->name . ' desbloqueado com sucesso.');

        return response()->json(['message' => 'Usuário '. $user->name . ' desbloqueado com sucesso.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        \Session::flash('success', 'Usuário '. $user->name . ' apagado com sucesso.');

        return response()->json(['message' => 'Usuário '. $user->name . ' apagado com sucesso.']);

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userList()
    {
        $users = User::where('id', '!=', 1)->orderBy('name', 'asc')->select('id', 'name', 'email')->get();
        return response()->json($users);
    }
}

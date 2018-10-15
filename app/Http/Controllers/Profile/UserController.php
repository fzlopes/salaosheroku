<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Permission\PasswordFormRequest;
use App\Http\Requests\Permission\PictureFormRequest;
use App\Http\Requests\Permission\ProfileFormRequest;
use App\User;
use File;

class UserController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePassword(PasswordFormRequest $request, $id)
    {
        if($request->ajax()) {
            $credentials = [
                'email' => Auth::user()->email,
                'password' => $request->get('current'),
            ];

            if(Auth::validate($credentials)) {
                $user = User::find(Auth::user()->id);
                $user->fill($request->only('password'));
                $user->password = bcrypt($user->password);
                $user->save();
                return response()->json([
                    'message' => 'Sua senha foi alterada com sucesso!'
                ]);
            } else {
                return response()->json([
                    'message' => 'senha atual não confere!'
                ], 401);
            }

        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePicture(PictureFormRequest $request, $id)
    {
        if($request->ajax()) {

            if ($request->file('picture')->isValid()) {

                $destinationPath = base_path() .  '/public/uploads/users/img';

                $user = User::find(Auth::user()->id);

                if ($user->picture) {
                    if(File::isFile($destinationPath.'/'.$user->picture)){
                        \File::delete($destinationPath.'/'.$user->picture);
                    }
                }

                $fileName = 'profile-'.Auth::user()->id . '.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move($destinationPath, $fileName);


                $user->fill($request->only('picture'));
                $user->picture = $fileName;
                $user->save();

                return response()->json([
                    'message' => 'Sua imagem de perfil foi alterada com sucesso. Para ver as alterações pressione CTRL + F5.'
                ]);

            } else {
                return response()->json([
                    'message' => 'A imagem enviada não é válida! Por favor, tente novamente.'
                ], 401);
            }

        }

        return response()->json(['message' => 'Sua senha foi alterada com sucesso!']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removePicture(Request $request, $id)
    {
        if($request->ajax()) {

            $user = User::find(Auth::user()->id);
            $destinationPath = base_path() .  '/public/uploads/users/img';

            if ($user->picture) {
                if(File::isFile($destinationPath.'/'.$user->picture)){
                    \File::delete($destinationPath.'/'.$user->picture);
                }
                $user->picture = '';
                $user->save();
                return response()->json([
                    'message' => 'Sua imagem de perfil foi removida com sucesso. Para ver as alterações pressione CTRL + F5.'
                ]);
            } else {
                return response()->json([
                    'message' => 'você não possui uma imagem para remover.'
                ], 401);
            }

        }

        return response()->json(['message' => 'Sua imagem de perfil foi removida com sucesso. Para ver as alterações pressione CTRL + F5.']);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeProfile(ProfileFormRequest $request, $id)
    {

        if($request->ajax()) {

            $user = User::find(Auth::user()->id);
            $user->fill($request->only('name','email'));
            $user->save();
            return response()->json([
                'message' => 'Seus dados foram alterados com sucesso!'
            ]);

        }


    }

}

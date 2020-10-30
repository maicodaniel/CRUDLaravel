<?php

namespace App\Http\Controllers\Form;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view ('Users\\listAll',
            [
                'users' => $users,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Users\\newUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valdata = $request->validate(['name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'cpf' => ['required', 'string', 'max:14', 'unique:users'],
        'dataNascimento' =>['required'],
        'telefone' =>['required'],
        'endereco' =>['required'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf =  str_replace(array('.','-','/'),'',$request->cpf);
        $user->dataNascimento = $request->dataNascimento;
        $user->sexo = $request->sexo;
        $user->endereco = $request->endereco;
        $user->telefone = $request->telefone;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usuario = array();
        $usuario['id'] = $user->id;
        $usuario['name'] = $user->name;
        $usuario['email'] = $user->email;
        $usuario['cpf'] = $user->cpf;
        $usuario['dataNascimento'] = $user->dataNascimento;
        $usuario['sexo'] = $user->sexo;
        $usuario['endereco'] = $user->endereco;
        $usuario['telefone'] = $user->telefone;
        $usuario['created_at'] = $user->created_at;
        $date1 = Carbon::create($user->dataNascimento);
        $date2 = Carbon::now();
        $usuario['idade'] = $date1->diffInYears($date2);
        $obj = (Object)$usuario;

        return view('Users\\listUser', ['user' => $obj]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('Users\\editUser', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf =  str_replace(array('.','-','/'),'',$request->cpf);
        $user->dataNascimento = $request->dataNascimento;
        $user->sexo = $request->sexo;
        $user->endereco = $request->endereco;
        $user->telefone = $request->telefone;

        $user->save();

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index');
    }

}

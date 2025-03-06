<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('rol:A')->only('create', 'store', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->rol == 'A')
        {
            $users = User::getUsers();
        }elseif(Auth::user()->rol == 'O')
        {
            $users = User::getMyData();
        }
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User($request->except('password_confirmation'));
        $user->password = Hash::make($request->password);
        $user->save();

        return to_route('user.index')->with('status', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Auth::user()->rol == 'A' || (Auth::user()->rol == 'O' && Auth::id() == $user->id)) {
            return view('user.edit', [
            'user' => $user
            ]);
        } else {
            return to_route('user.edit', Auth::id())->with('status', 'No tienes permisos para editar este usuario');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (Auth::user()->rol == 'O') {
            $user->update($request->only('email', 'created_at'));
        } else {
            $user->update($request->except('password_confirmation', 'password'));
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
                $user->save();
            }
        }
        return to_route('user.index')->with('status', 'Usuario actualizado correctamente');
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
        return to_route('user.index')->with('status', 'Usuario eliminado correctamente');
    }

    public function denegar(User $user)
    {
        if ($user->access == 1) {
            $user->access = 0;
        } else {
            $user->access = 1;
        }
        $user->save();
        return to_route('user.index')->with('status', 'Acceso actualizado correctamente');
    }
}

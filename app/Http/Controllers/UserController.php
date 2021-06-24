<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        $user = User::find($id);

        return $user;
    }

    public function fancyShow(Request $request, User $user)
    {
        return $user;
    }

    public function weirdShow(Request $request, User $snowflake)
    {
        return $snowflake;
    }

    public function create()
    {
        return view('create');
    }

    public function store()
    {
        // 1st yuck
        $req = request();

        request()->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(Str::random(40)),
        ]);

        return $user;




        // oh baby
        // $request->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make(Str::random(40)),
        // ]);

        // return $user;
    }
}

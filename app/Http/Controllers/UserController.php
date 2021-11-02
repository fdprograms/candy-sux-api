<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Role;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *fffffff
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = Company::create(
            [
                'uuid' => \Str::uuid(),
                'name' => $request->company['name'],
                'rnc' => $request->company['rnc']
            ]
        );
        $user = $company->users()->create([
            'uuid' => \Str::uuid(),
            'name' => $request->user['name'],
            'email' => $request->user['email'],
            'password' => Hash::make($request->user['password'])
        ]);

        $roleId = Role::where('name', 'Owner')->first()->id;
        $user->roles()->attach($roleId);
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname
        ]);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}

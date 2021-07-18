<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\web_users as WebUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WebUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('WebUsers/Index', [
            'users' => WebUser::select(["kd_users", "name", "username", "email"])
                ->orderByDesc('updated_at')
                ->limit(10)
                ->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('WebUsers/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = WebUser::create(
            $request->validate([
                'name' => ['required', 'max:100'],
                'email' => ['required'],
                'username' => ['required'],
                'password' => ['required'],
                'level' => ['required', 'numeric'],
            ])
        );

        $video->save();

        return Redirect::route('user')->with('success', 'User created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WebUser  $WebUser
     * @return \Illuminate\Http\Response
     */
    public function show(WebUser $WebUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebUser  $WebUser
     * @return \Illuminate\Http\Response
     */
    public function edit(WebUser $user)
    {
        return Inertia::render('WebUsers/Edit', [
            'user' => [
                'kd_users' => $user->kd_users,
                'name' => $user->name,
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
                'level' => $user->level,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebUser  $WebUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebUser $user)
    {
        $user->update(
            $request->validate([
                'name' => ['required', 'max:100'],
                'email' => ['required'],
                'username' => ['required'],
                'password' => ['required'],
                'level' => ['required', 'numeric'],
            ])
        );

        return Redirect::back()->with('success', 'User updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebUser  $WebUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebUser $user)
    {
        $user->delete();

        return Redirect::route('user')->with('success', 'User deleted.');
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\web_access as WebAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class WebAccessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('WebProfile/Index', [
            'accesss' => WebAccess::select(["kd_access", "kd_users", "kd_menu"])
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
        return Inertia::render('WebAccess/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = WebAccess::create(
            $request->validate([
                'subject' => ['required'],
                'content' => ['required'],
                'publish' => ['required', 'numeric'],
            ])
        );

        $menu->save();

        return Redirect::route('profile')->with('success', 'Profile created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\web_profile  $web_profile
     * @return \Illuminate\Http\Response
     */
    public function show(WebAccess $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebAccess  $WebAccess
     * @return \Illuminate\Http\Response
     */
    public function edit(WebAccess $profile)
    {
        return Inertia::render('WebAccess/Edit', [
            'profile' => [
                'kd_profile' => $profile->kd_profile,
                'subject' => $profile->subject,
                'content' => $profile->content,
                'publish' => $profile->publish,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebAccess  $WebAccess
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebAccess $profile)
    {
        $profile->update(
            $request->validate([
                'subject' => ['required'],
                'content' => ['required'],
                'publish' => ['required', 'numeric'],
            ])
        );

        return Redirect::route('profile')->with('success', 'Profile updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WebAccess  $WebAccess
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebAccess $profile)
    {
        $profile->delete();

        return Redirect::route('profile')->with('success', 'Profile deleted.');
    }
}

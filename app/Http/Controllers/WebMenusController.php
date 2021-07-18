<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\web_menu as WebMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WebMenusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('WebMenu/Index', [
            'menus' => WebMenu::select(["kd_menu", "name", "site_url"])
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
        return Inertia::render('WebMenu/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menu = WebMenu::create(
            $request->validate([
                'name' => ['required'],
                'site_url' => ['required'],
            ])
        );

        $menu->save();

        return Redirect::route('menu')->with('success', 'Menu created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\web_menu  $web_menu
     * @return \Illuminate\Http\Response
     */
    public function show(WebMenu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WebMenu  $WebMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(WebMenu $menu)
    {
        return Inertia::render('WebMenu/Edit', [
            'menu' => [
                'kd_menu' => $menu->kd_menu,
                'name' => $menu->name,
                'site_url' => $menu->site_url,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WebMenu  $WebMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebMenu $menu)
    {
        $menu->update(
            $request->validate([
                'name' => ['required'],
                'site_url' => ['required'],
            ])
        );

        return Redirect::route('menu')->with('success', 'Menu updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\web_menu  $web_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebMenu $menu)
    {
        $menu->delete();

        return Redirect::route('menu')->with('success', 'Menu deleted.');
    }
}

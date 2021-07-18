<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\web_video as WebVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WebVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('WebVideo/Index', [
            'videos' => WebVideo::select(["kd_video", "subject", "link"])
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
        return Inertia::render('WebVideo/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $video = WebVideo::create(
            $request->validate([
                'subject' => ['required', 'max:100'],
                'link' => ['required'],
                'content' => ['required'],
                'publish' => ['required', 'numeric'],
            ])
        );

        $video->save();

        return Redirect::route('video')->with('success', 'Video created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\web_video $web_video
     * @return \Illuminate\Http\Response
     */
    public function show(WebVideo $web_video)
    {
        return view('web_videos.show', compact('web_video'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\web_video $video
     * @return \Illuminate\Http\Response
     */
    public function edit(WebVideo $video)
    {
        return Inertia::render('WebVideo/Edit', [
            'video' => [
                'kd_video' => $video->kd_video,
                'subject' => $video->subject,
                'link' => $video->link,
                'content' => $video->content,
                'publish' => $video->publish,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\web_video $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WebVideo $video)
    {
        $video->update(
            $request->validate([
                'subject' => ['required', 'max:100'],
                'link' => ['required'],
                'content' => ['required'],
                'publish' => ['required', 'numeric'],
            ])
        );

        return Redirect::back()->with('success', 'Video updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\web_video $web_video
     * @return \Illuminate\Http\Response
     */
    public function destroy(WebVideo $video)
    {
        $video->delete();

        return Redirect::route('video')->with('success', 'Video deleted.');
    }
}

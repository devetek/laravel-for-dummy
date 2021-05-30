<?php

namespace App\Http\Controllers;

use PDF;
use Inertia\Inertia;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Mahasiswa/Index', [
            'mahasiswas' => Mahasiswa::select(["id", "nis", "fullname", "major", "address"])
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
        return Inertia::render('Mahasiswa/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mahasiswa = Mahasiswa::create(
            $request->validate([
                'nis' => ['required', 'numeric'],
                'fullname' => ['required'],
                'major' => ['nullable'],
                'address' => ['nullable'],
            ])
        );

        $mahasiswa->save();

        return Redirect::route('mahasiswa')->with('success', 'Mahasiswa created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        return Inertia::render('Mahasiswa/Edit', [
            'mahasiswa' => [
                'id' => $mahasiswa->id,
                'nis' => $mahasiswa->nis,
                'fullname' => $mahasiswa->fullname,
                'major' => $mahasiswa->major,
                'address' => $mahasiswa->address,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $mahasiswa->update(
            $request->validate([
                'nis' => ['required', 'numeric'],
                'fullname' => ['required'],
                'major' => ['nullable'],
                'address' => ['nullable'],
            ])
        );

        return Redirect::back()->with('success', 'Mahasiswa updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return Redirect::route('mahasiswa')->with('success', 'Mahasiswa deleted.');
    }

    /**
     * Export all data mahasiswa to PDF
     * 
     * @return \Barryvdh\DomPDF\PDF
     */
    public function createPDF()
    {
        // retreive all records from db
        $data = Mahasiswa::all();

        $data = [
            'title' => "Pengaturan Mahasiswa",
            'mahasiswa' => $data,
        ];

        // share data to view
        $pdf = PDF::loadView('mahasiswa/pdf', $data);

        // download PDF file with download method
        return $pdf->download('pdf_mahasiswa.pdf');
    }
}

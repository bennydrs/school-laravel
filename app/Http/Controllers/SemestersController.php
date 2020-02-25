<?php

namespace App\Http\Controllers;

use App\Semester;
use Illuminate\Http\Request;

class SemestersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('semester.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('semester.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'semester' => 'required',
                'tahun_ajaran' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
            ]
        );

        $tahun_ajaran = $request->tahun_ajaran;

        $semester = ($request->semester == 'Genap') ? '01' : '02';
        $tahun_pertama = substr($tahun_ajaran, 2, 2);
        $tahun_kedua = substr($tahun_ajaran, 7, 2);
        $kode_semester = 'SM' . $tahun_pertama . '' . $tahun_kedua . '' . $semester;
        if (Semester::where('kode_semester', '=', $kode_semester)->exists()) {
            return redirect('/semesters/create')->with('error', 'Data semester sudah ada!')->withInput();
        }

        $request->request->add(['kode_semester' => $kode_semester]);
        $semester = Semester::create($request->all());
        return redirect('/semesters')->with('status', 'Data semester berhasil ditambah!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function edit(Semester $semester)
    {
        return view('semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Semester $semester)
    {
        $cek = Semester::where('semester', '=', $request->semester)->where('tahun_ajaran', '=', $request->tahun_ajaran)->first();
        if ($cek && $cek->id != $semester->id) {
            return redirect('semesters/' . $semester->id . '/edit')->with('error', 'Data semester ajar sudah ada!')->withInput();
        }

        $semester = Semester::find($semester->id);
        $semester->update($request->all());
        $semester->save();
        return redirect('semesters')->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Semester  $semester
     * @return \Illuminate\Http\Response
     */
    public function destroy(Semester $semester)
    {
        Semester::destroy($semester->id);
        return redirect('semesters')->with('status', 'Data berhasil dihapus!');
    }

    public function getdatasemester()
    {
        $semesters = Semester::select('semesters.*');
        return \DataTables::eloquent($semesters)
            ->addIndexColumn()
            ->addColumn('aksi', function ($s) {
                return '
                        <a href="/semesters/' . $s->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
                        <form action="/semesters/' . $s->id . '" method="post" class="d-inline delete">   
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                        </form>';
            })
            ->rawColumns(['aksi'])
            ->tojson();
    }
}

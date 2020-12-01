<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('mata_pelajaran.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodeTerakhir = Subject::max('kode_mapel');
        return view('mata_pelajaran.create', compact('kodeTerakhir'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mapel' => 'required|unique:subjects',
            'nama' => 'required'
        ]);

        Subject::create($request->all());
        return redirect('/subjects')->with('status', 'Data mata pelajaran berhasil ditambah');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        return view('mata_pelajaran.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $request->validate([
            'kode_mapel' => 'required',
            'nama' => 'required'
        ]);
        $subject = Subject::find($subject->id);
        $subject->update($request->all());
        $subject->save();
        return redirect('/subjects')->with('status', 'Data mapel berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        Subject::destroy($subject->id);
        return redirect('/subjects')->with('status', 'Data mapel berhasil dihapus!');
    }

    public function getdatasubject()
    {
        $subjects = Subject::select('subjects.*');

        return \DataTables::eloquent($subjects)
            ->addIndexColumn()
            ->addColumn('aksi', function ($s) {
                return '
                <a href="/subjects/' . $s->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
                <form action="/subjects/' . $s->id . '" method="post" class="d-inline delete">   
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                </form>';
            })
            ->rawColumns(['aksi'])
            ->tojson();
    }
}

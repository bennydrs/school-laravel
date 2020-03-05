<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class ClassRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kelas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kodeTerakhir = ClassRoom::max('kode_kelas');

        $teachers = \App\Teacher::all();
        return view('kelas.create', compact('kodeTerakhir'), compact('teachers'));
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
                'nama' => 'required|unique:class_rooms',
            ],
            [
                'required' => ':attribute wajib diisi',
                'unique' => ':attribute kelas sudah tersedia',
            ]
        );
        ClassRoom::create($request->all());
        return redirect('/class-rooms')->with('status', 'Data Kelas berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $classRoom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $classRoom)
    {
        $teachers = \App\Teacher::all();
        return view('kelas.edit', compact('classRoom', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $classRoom)
    {
        $classRoom = ClassRoom::find($classRoom->id);
        $classRoom->update($request->all());
        return redirect('/class-rooms')->with('status', 'Data kelas berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClassRoom  $classRoom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $classRoom)
    {
        ClassRoom::destroy($classRoom->id);
        return redirect('/class-rooms')->with('status', 'Data berhasil dihapus');
    }

    public function getdataclass()
    {
        $classRooms = ClassRoom::select('class_rooms.*');
        return \DataTables::eloquent($classRooms)
            ->addIndexColumn()
            ->addColumn('aksi', function ($c) {
                return '<a href="/class-rooms/' . $c->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
                <form action="/class-rooms/' . $c->id . '" method="post" class="d-inline delete">   
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                </form>';
            })
            ->rawColumns(['aksi'])
            ->tojson();
    }
}

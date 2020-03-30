<?php

namespace App\Http\Controllers;

use App\Information;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class InformationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pengumuman.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.create');
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
                'judul' => 'required',
                'konten' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
            ]
        );

        Information::create($request->all());
        return redirect('/informations')->with('status', 'Data information berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function show(Information $information)
    {
        $information = Information::find($information->id);
        return view('pengumuman.show', compact('information'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function edit(Information $information)
    {
        $information = Information::find($information->id);
        return view('pengumuman.edit', compact('information'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Information $information)
    {
        $request->validate(
            [
                'judul' => 'required',
                'konten' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
            ]
        );

        $information = Information::find($information->id);
        $information->update($request->all());
        $information->save();
        return redirect('/informations')->with('status', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Information  $information
     * @return \Illuminate\Http\Response
     */
    public function destroy(Information $information)
    {
        Information::destroy($information->id);
        return redirect('/informations')->with('status', 'Data berhasil dihapus');
    }

    public function getdatainformation()
    {
        $informations = Information::select('informations.*');

        return \DataTables::eloquent($informations)
            ->addIndexColumn()
            ->addColumn('konten', function ($k) {
                return str_limit($k->konten, 50);
            })
            ->addColumn('publish', function ($ak) {
                return ($ak->publish == 1) ?  'publish'  : 'tidak publish!';
            })
            ->addColumn('aksi', function ($info) {
                if ($info->user_id != auth()->user()->id) {
                    return '<a href="/informations/' . $info->id . '" class="btn btn-info btn-sm">lihat</a> <a href="/informations/' . $info->id . '/edit" class="btn btn-warning btn-sm">edit</a>';
                }
                return '
                <a href="/informations/' . $info->id . '" class="btn btn-info btn-sm">lihat</a> 
                <a href="/informations/' . $info->id . '/edit" class="btn btn-warning btn-sm">edit</a>
                <form action="/informations/' . $info->id . '" method="post" class="d-inline delete">   
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                </form>';
            })
            ->rawColumns(['aktif', 'aksi'])
            ->tojson();
    }
}

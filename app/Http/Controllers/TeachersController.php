<?php

namespace App\Http\Controllers;

use App\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class TeachersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();
        return view('guru.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nrgTerakhir = Teacher::max('nrg');
        return view('guru.create', compact('nrgTerakhir'));
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
                'nrg' => 'required|unique:teachers',
                'nama' => 'required',
                'email' => 'required|unique:users|email',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'telp' => 'required',
                'alamat' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
                'min' => ':attribute minimal :min karakter',
                'unique' => ':attribute sudah terdaftar',
                'email' => ':attribute yang diisi bukan email'
            ]
        );

        // insert ke users
        $user = new \App\User;
        $user->role = 'guru';
        $user->name = $request->nama;
        $user->username = $request->nrg;
        $user->email = $request->email;
        $user->password = bcrypt('123');
        $user->remember_token = str_random(60);
        $user->save();

        // insert ke students
        $request->request->add(['user_id' => $user->id]);
        Teacher::create($request->all());

        return redirect('/teachers')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $schedules = \App\Schedule::where('teacher_id', '=', $teacher->id)->get();
        return view('guru.profil', compact('teacher', 'schedules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('guru.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate(
            [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
            ],
            [
                'required' => ':attribute wajib diisi',
                'min' => ':attribute minimal :min karakter',
                'unique' => ':attribute sudah terdaftar',
                'email' => ':attribute yang diisi bukan email'
            ]
        );

        $teacher = Teacher::findOrFail($teacher)->first();
        $teacher->update($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/guru/', $request->file('foto')->getClientOriginalName());
            $teacher->foto = $request->file('foto')->getClientOriginalName();
            $teacher->save();
        }
        return redirect('/teachers')->with('status', 'Data guru berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        \App\User::destroy($teacher->user_id);
        Teacher::destroy($teacher->id);
        return redirect('/teachers')->with('status', 'Data berhasil dihapus');
    }

    public function getdatateachers()
    {
        $teachers = Teacher::select('teachers.*');
        return \DataTables::eloquent($teachers)
            ->addIndexColumn()
            ->addColumn('aksi', function ($t) {
                return
                    '<a href="/teachers/' . $t->id . '" class="btn btn-info btn-sm">detail</a>
                    <a href="/teachers/' . $t->id . '/edit" class="btn btn-warning btn-sm">edit</a>
                    <form action="/teachers/' . $t->id . '" method="post" class="d-inline delete">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger btn-sm delete">hapus</button>
                    </form>';
            })

            ->rawColumns(['aksi'])
            ->tojson();
    }
}

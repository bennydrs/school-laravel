<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
                'nip' => 'required|unique:admins',
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
        $user->role = 'admin';
        $user->name = $request->nama;
        $user->username = $request->nip;
        $user->email = $request->email;
        $user->password = bcrypt('123');
        $user->remember_token = str_random(60);
        $user->save();

        // insert ke students
        $request->request->add(['user_id' => $user->id]);
        Admin::create($request->all());

        return redirect('/admins')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        return view('admin.profil', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        return view('admin.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        $admin = Admin::find($admin->id);
        $admin->update($request->all());
        $admin->save();
        return redirect('admin')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        if ($admin->id == auth()->user()->admin->id) {
            return redirect('/admins')->with('error', 'Data ini punya kamu');
        } else {
            \App\User::destroy($admin->user_id);
            Admin::destroy($admin->id);
            return redirect('/admins')->with('status', 'Data berhasil dihapus!');
        }
    }

    public function getdataadmin()
    {
        $admins = Admin::select('admins.*');
        return \DataTables::eloquent($admins)
            ->addIndexColumn()
            ->addColumn('aksi', function ($ad) {
                if ($ad->user_id != auth()->user()->id) {
                    return '<a href="/admins/' . $ad->id . '" class="btn btn-info btn-sm">detail</a>
                    <form action="/admins/' . $ad->id . '" method="post" class="d-inline delete">   
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                </form>';
                }
                return '<a href="/admins/' . $ad->id . '" class="btn btn-info btn-sm">detail</a>
                ';
            })
            ->rawColumns(['aksi'])
            ->tojson();
    }

    public function profileAdmin()
    {
        // $schedules = \App\Schedule::where('teacher_id', '=', auth()->user()->teacher->id)->get();
        $admin = Admin::find(auth()->user()->admin->id);
        return view('admin.profil', compact('admin'));
    }

    public function editAdmin()
    {
        $admin = Admin::find(auth()->user()->admin->id);
        return view('user.admin.edit', compact('admin'));
    }
}

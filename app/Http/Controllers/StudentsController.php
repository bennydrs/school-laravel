<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();
        return view('siswa.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nisTerakhir = Student::max('nis');
        $classes = \App\ClassRoom::all();
        return view('siswa.create', compact('nisTerakhir', 'classes'));
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
                'nis' => 'required|unique:students|min:5',
                'nama' => 'required',
                'email' => 'required|unique:users|email',
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

        // insert ke users
        $user = new \App\User;
        $user->role = 'siswa';
        $user->name = $request->nama;
        $user->username = $request->nis;
        $user->email = $request->email;
        $user->password = bcrypt('123');
        $user->remember_token = str_random(60);
        $user->save();

        // insert ke students
        $request->request->add(['user_id' => $user->id]);
        $student = Student::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $student->foto = $request->file('foto')->getClientOriginalName();
            $student->save();
        }

        return redirect('/students')->with('status', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // $classLearn = \App\ClassLearn::where('class_room_id', '=', $student->class_room_id)->get();
        $grades = \App\Grade::where('student_id', '=', $student->id)->get();
        return view('siswa.profil', compact('student', 'grades'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('siswa.edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
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

        $student = Student::findOrFail($student)->first();
        $student->update($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $student->foto = $request->file('foto')->getClientOriginalName();
            $student->save();
        }
        return redirect('/students')->with('status', 'Data berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        \App\User::destroy($student->user_id);
        Student::destroy($student->id);
        return redirect('/students')->with('status', 'Data berhasil dihapus');
    }

    public function getdatastudent()
    {
        $students = Student::select('students.*');

        return \DataTables::eloquent($students)
            ->addIndexColumn()
            ->addColumn('kelas', function ($s) {
                return $s->classRoom->nama;
            })
            ->addColumn('aksi', function ($s) {
                return '<a href="/students/' . $s->id . '" class="btn btn-info btn-sm">detail</a>
                <a href="/students/' . $s->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
                <form action="/students/' . $s->id . '" method="post" class="d-inline delete">   
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
                </form>';
            })
            ->rawColumns(['aksi', 'kelas'])
            ->tojson();
    }

    public function profileStudent()
    {
        // $schedules = \App\Schedule::where('teacher_id', '=', auth()->user()->teacher->id)->get();
        $student = Student::find(auth()->user()->student->id);
        return view('user.siswa.profil', compact('student'));
    }

    public function schedulesStudent(Request $request)
    {
        $classes = \App\ClassRoom::all();
        $semesters = \App\Semester::all();
        $schedules = \App\Schedule::where('class_room_id', '=', $request->kelas)->where('semester_id', '=', $request->semester)->get();
        return view('user.siswa.jadwal', compact('schedules', 'classes', 'semesters'));
    }
}

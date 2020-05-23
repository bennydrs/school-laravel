<?php

namespace App\Http\Controllers;

use App\HomeroomTeacher;
use App\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\DB;
use File;

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

        // insert ke teacher
        $request->request->add(['user_id' => $user->id]);
        $teacher = Teacher::create($request->all());
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('img/guru', $request->file('foto')->getClientOriginalName());
            $teacher->foto = $request->file('foto')->getClientOriginalName();
            $teacher->save();
        }

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

        $teachers = Teacher::find($teacher->id);
        if ($request->hasFile('foto')) {
            // dd($student->foto);
            File::delete('img/' . $teacher->foto);
            $request->file('foto')->move('img/guru/', $request->file('foto')->getClientOriginalName());
            $teachers->foto = $request->file('foto')->getClientOriginalName();
        }
        $teachers->nrg = $request->nrg;
        $teachers->nama = $request->nama;
        $teachers->tempat_lahir = $request->tempat_lahir;
        $teachers->tanggal_lahir = $request->tanggal_lahir;
        $teachers->jenis_kelamin = $request->jenis_kelamin;
        $teachers->telp = $request->telp;
        $teachers->agama = $request->agama;
        $teachers->alamat = $request->alamat;
        $teachers->save();
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

    public function profileTeacher()
    {
        $teacher = Teacher::find(auth()->user()->teacher->id);
        return view('user.guru.profil', compact('teacher'));
    }

    public function schedulesTeacher(Request $request)
    {
        $semesters = \App\Semester::all();
        $schedules = \App\Schedule::where('teacher_id', auth()->user()->teacher->id)->where('semester_id', $request->semester)->get();
        // $teacher = Teacher::find(auth()->user()->teacher->id);
        return view('user.guru.jadwal', compact('schedules', 'semesters'));
    }

    public function indexGradeTeacher(Request $request)
    {
        $classes = \App\Schedule::where('teacher_id', auth()->user()->teacher->id)->get();
        $semesters = \App\Semester::all();
        $classSelected = \App\ClassRoom::find($request->kelas);

        $grades = \App\Grade::where('class_room_id', $request->kelas)->where('semester_id', $request->semester)->where('teacher_id', auth()->user()->teacher->id)->get();

        return view('user.guru.nilai.index', compact('classes', 'semesters', 'grades', 'classSelected'));
    }

    public function createGradeTeacher($class_id, $semester_id, Request $request)
    {
        $id = $request->subject;

        $semester = \App\Semester::find($semester_id);
        $class = \App\ClassRoom::find($class_id);

        $schedule = \App\Schedule::where('class_room_id', $class_id)->where('semester_id', $semester_id)->where('teacher_id', auth()->user()->teacher->id)->get();

        if ($request->all()) {
            $students = DB::table('class_students')->where('class_room_id', $class_id)
                ->join('students', 'students.id', '=', 'class_students.student_id')
                ->select('students.nama', 'students.id as student_id', 'class_students.*')
                ->whereNotExists(function ($query) use ($id, $semester_id) {
                    $query->select(DB::raw(1))
                        ->from('grades')
                        ->whereRaw('grades.class_learn_id =' . $id)
                        ->whereRaw('grades.semester_id =' . $semester_id)
                        ->whereRaw('grades.class_student_id = class_students.id');
                })
                ->get();

            return view('user.guru.nilai.create', compact('class', 'schedule', 'semester', 'students'));
        } else {
            return view('user.guru.nilai.create', compact('class', 'schedule', 'semester'));
        }
    }

    public function storeGradeTeacher(Request $request)
    {
        foreach ($request->class_student_id as $key => $value) {
            // dd($value);
            \App\Grade::create([
                'class_student_id' => $value,
                'class_learn_id' => $request->class_learn_id,
                'class_room_id' => $request->class_room_id[$key],
                'semester_id' => $request->semester_id[$key],
                'teacher_id' => $request->teacher_id[$key],
                'nilai_tugas_1' => $request->nilai_tugas_1[$key],
                'nilai_tugas_2' => $request->nilai_tugas_2[$key],
                'nilai_uts' => $request->nilai_uts[$key],
                'nilai_uas' => $request->nilai_uas[$key],
                'student_id' => $request->student_id[$key],
            ]);
        }
        return redirect('teacher/grades?kelas=' . $request->class_room_id[$key] . '&semester=' . $request->semester_id[$key] . '')->with('status', 'Data nilai berhasil ditambah!');
    }

    public function indexHomeroomTeacher(Request $request)
    {
        $semesters = \App\Semester::all();

        $homeroomTeachers = HomeroomTeacher::where('semester_id', $request->semester)->where('teacher_id', auth()->user()->teacher->id)->get();
        return view('user.guru.wali_kelas.index', compact('semesters', 'homeroomTeachers'));
    }

    public function showStudentHomeroomTeacher($class_id, $semester_id)
    {
        // $semesters = \App\Semester::all();
        // $homeroomTeachers = HomeroomTeacher::where('semester_id', $request->semester)->where('teacher_id', auth()->user()->teacher->id)->get();
        // dd($request->all());
        // $students = \App\ClassStudent::where('semester_id', $request->semester)->where('class_room_id', '=', $request->kelas)->get();
        $semester = \App\Semester::where('id', $semester_id)->first();
        // dd($semester->tahun_ajaran);
        $s = \App\Semester::where('tahun_ajaran', $semester->tahun_ajaran)->get();
        // dd($s);
        $classStudents = \App\ClassStudent::where('class_room_id', $class_id)->where('semester_id', $semester_id)->get();
        // dd($classes);
        // $grades = \App\Grade::where('class_room_id', $class_id)->get();
        return view('user.guru.wali_kelas.show_student', compact('classStudents', 's'));
    }

    public function showGradeHomeroomTeacher($class_student_id, $semester_id)
    {
        $student = \App\ClassStudent::find($class_student_id);
        $class_room_id = $student->class_room_id;

        // $nilai = DB::table('class_learns')
        //     ->leftJoin('grades', 'class_learns.id', '=', 'grades.class_learn_id')
        //     ->leftJoin('subjects', 'class_learns.subject_id', '=', 'subjects.id')
        //     ->select('subjects.*', 'grades.*')
        //     ->where('class_learns.class_room_id', $grades->classStudent->class_room_id)
        //     ->get();

        $nilai = DB::table('class_learns')
            ->leftJoin('subjects', 'subjects.id', '=', 'class_learns.subject_id')
            ->select('class_learns.*', 'grades.*', 'grades.class_learn_id', 'subjects.nama')
            ->leftJoin('grades', function ($leftJoin) use ($class_student_id, $semester_id, $class_room_id) {
                $leftJoin->on('grades.class_learn_id', '=', 'class_learns.id');
                $leftJoin->where('grades.class_room_id', '=', $class_room_id);
                $leftJoin->where('grades.semester_id', '=', $semester_id);
                $leftJoin->where('grades.class_student_id', '=', $class_student_id);
                // $leftJoin->on(DB::raw('grades.class_student_id'), DB::raw('='), DB::raw("'" . $class_student_id . "'"));
            })->get();
        // dd($nilai);

        return view('user.guru.wali_kelas.show_grade', compact('student', 'nilai', 'class_room_id', 'semester_id'));
    }

    public function editTeacher()
    {
        // $schedules = \App\Schedule::where('teacher_id', '=', auth()->user()->teacher->id)->get();
        $teacher = Teacher::find(auth()->user()->teacher->id);
        return view('user.guru.edit_profil', compact('teacher'));
    }

    public function updateTeacher(Request $request, Teacher $teacher)
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
        return redirect('/teacher/profile')->with('status', 'Data guru berhasil diubah');
    }
}

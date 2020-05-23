<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\ClassStudent;
use App\Student;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Support\Facades\DB;
use File;

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
                'foto' => 'mimes:jpeg,png,jpg',
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
        // $grades = \App\Grade::where('student_id', '=', $student->id)->get();
        $classStudent = \App\ClassStudent::where('student_id', $student->id)->first();
        // dd($classStudent->id);
        $grades = \App\Grade::where('class_student_id', $classStudent->id)->get();
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
        // dd($request->foto);
        $request->validate(
            [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'foto' => 'mimes:jpeg,png,jpg',
            ],
            [
                'required' => ':attribute wajib diisi',
                'min' => ':attribute minimal :min karakter',
                'unique' => ':attribute sudah terdaftar',
                'email' => ':attribute yang diisi bukan email',
                'mimes' => ':attribute bukan file gambar'
            ]
        );

        $students = Student::find($student->id);
        if ($request->hasFile('foto')) {
            // dd($student->foto);
            File::delete('img/' . $student->foto);
            $request->file('foto')->move('img/', $request->file('foto')->getClientOriginalName());
            $students->foto = $request->file('foto')->getClientOriginalName();
        }
        $students->nis = $request->nis;
        $students->nama = $request->nama;
        $students->tempat_lahir = $request->tempat_lahir;
        $students->tanggal_lahir = $request->tanggal_lahir;
        $students->jenis_kelamin = $request->jenis_kelamin;
        $students->agama = $request->agama;
        $students->alamat = $request->alamat;
        $students->save();
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
        File::delete('img/' . $student->foto);
        \App\User::destroy($student->user_id);
        Student::destroy($student->id);
        return redirect('/students')->with('status', 'Data berhasil dihapus');
    }

    public function getdatastudent()
    {
        $students = Student::select('students.*');

        return \DataTables::eloquent($students)
            ->addIndexColumn()
            // ->addColumn('kelas', function ($s) {
            //     return $s->classRoom->nama;
            // })
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

    public function classStudent(Request $request)
    {
        $semester_id = $request->semester;
        $classes = \App\ClassRoom::all();
        $semesters = \App\Semester::all();
        $classStudents = \App\ClassStudent::where('semester_id', '=', $semester_id)->get();
        if ($request->all()) {
            $studentNotExists = DB::table('students')
                // ->leftJoin('class_students', 'class_students.student_id', '=', 'students.id')
                ->select('students.id', 'students.nama')
                ->whereNotExists(function ($query) use ($semester_id) {
                    $query->select(DB::raw(1))
                        ->from('class_students')
                        ->whereRaw('class_students.semester_id =' . $semester_id)
                        ->whereRaw('class_students.student_id = students.id');
                })
                // ->orderBy('class_students.class_room_id', 'asc')
                ->get();
            // dd($studentNotExists);
            return view('kelas_siswa.index', compact('classStudents', 'classes', 'semesters', 'studentNotExists'));
        } else {
            return view('kelas_siswa.index', compact('classStudents', 'classes', 'semesters'));
        }
    }

    public function storeClassStudentByStudent(Request $request)
    {
        foreach ($request->student_id as $key => $value) {
            // dd($value);
            ClassStudent::create([
                'student_id' => $value,
                'class_room_id' => $request->class_room_id,
                'semester_id' => $request->semester_id,
            ]);
        }
        return redirect('class-students?semester=' . $request->semester_id)->with('status', 'Data kelas siswa berhasil ditambah!');
    }

    public function destroyClassStudent(ClassStudent $classStudent)
    {
        // dd($classStudent);
        ClassStudent::destroy($classStudent->id);
        return redirect('class-students?semester=' . $classStudent->semester_id)->with('status', 'Data kelas siswa berhasil dihapus!');
    }

    public function createClassStudent($semester_id)
    {
        $semester = \App\Semester::find($semester_id);
        return view('kelas_siswa.create', compact('semester'));
    }

    // public function createClassStudentByStudent($semester_id, $class_id)
    // {
    //     $students = DB::table('students')
    //         // ->join('students', 'students.id', '=', 'class_students.student_id')
    //         ->select('students.nama')
    //         ->whereNotExists(function ($query) use ($class_id) {
    //             $query->select(DB::raw(1))
    //                 ->from('class_students')
    //                 ->whereRaw('class_students.class_room_id =' . $class_id)
    //                 ->whereRaw('class_students.student_id = students.id');
    //         })
    //         ->get();
    //     // dd($students);
    //     return view('kelas_siswa.create_by_student');
    // }

    public function profileStudent()
    {
        // $schedules = \App\Schedule::where('teacher_id', '=', auth()->user()->teacher->id)->get();
        $student = Student::find(auth()->user()->student->id);
        return view('user.siswa.profil', compact('student'));
    }

    public function editStudent()
    {
        // $schedules = \App\Schedule::where('teacher_id', '=', auth()->user()->teacher->id)->get();
        $student = Student::find(auth()->user()->student->id);
        return view('user.siswa.edit_profil', compact('student'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $request->validate(
            [
                'nama' => 'required',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required',
                'jenis_kelamin' => 'required',
                'agama' => 'required',
                'alamat' => 'required',
                'foto' => 'mimes:jpeg,png,jpg',
            ],
            [
                'required' => ':attribute wajib diisi',
                'min' => ':attribute minimal :min karakter',
                'unique' => ':attribute sudah terdaftar',
                'email' => ':attribute yang diisi bukan email',
                'mimes' => ':attribute bukan file gambar'
            ]
        );

        $students = Student::find($student->id);
        $students->nis = $request->nis;
        $students->nama = $request->nama;
        $students->tempat_lahir = $request->tempat_lahir;
        $students->jenis_kelamin = $request->jenis_kelamin;
        $students->agama = $request->agama;
        $students->alamat = $request->alamat;
        $students->save();
        return redirect('/student/profile')->with('status', 'Data berhasil diubah');
    }

    public function schedulesStudent(Request $request)
    {
        // dd(auth()->user()->student->id);
        $classes = \App\ClassStudent::where('student_id', '=', auth()->user()->student->id)->get();
        $semesters = \App\Semester::all();
        $schedules = \App\Schedule::where('class_room_id', '=', $request->kelas)->where('semester_id', '=', $request->semester)->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")->get();
        return view('user.siswa.jadwal', compact('schedules', 'classes', 'semesters'));
    }

    public function gradesStudent(Request $request)
    {
        $student = \App\ClassStudent::find($request->kelas);
        $classes = \App\ClassStudent::where('student_id', '=', auth()->user()->student->id)->get();

        $semesters = \App\Semester::all();
        $class_student_id = $request->kelas;
        $semester_id = $request->semester;
        // $class_room_id = $student->class_room_id;

        $nilai = DB::table('class_learns')
            ->leftJoin('subjects', 'subjects.id', '=', 'class_learns.subject_id')
            ->select('class_learns.*', 'grades.*', 'grades.class_learn_id', 'subjects.nama')
            ->leftJoin('grades', function ($leftJoin) use ($class_student_id, $semester_id) {
                $leftJoin->on('grades.class_learn_id', '=', 'class_learns.id');
                // $leftJoin->where('grades.class_room_id', '=', $class_room_id);
                $leftJoin->where('grades.semester_id', '=', $semester_id);
                $leftJoin->where('grades.class_student_id', '=', $class_student_id);
            })->get();

        $nilai->map(function ($n) {

            $jmltugas = $n->nilai_tugas_1 + $n->nilai_tugas_2;
            $rata2tugas = $jmltugas / 2;

            $tugas = $rata2tugas * 0.25;
            $uts = $n->nilai_uts * 0.35;
            $uas = $n->nilai_uas * 0.40;
            $rata2 = $tugas + $uts + $uas;

            $n->rata2 = $rata2;

            return $n;
        });
        $sum = 0;
        $hitung = 0;

        foreach ($nilai->unique('subject_id') as $n) {
            $sum += $n->rata2;

            if ($n->rata2 > 0.0) {
                $hitung++;
            }
        }

        // dd($nilai);
        if ($request->semester) {
            $total = $hitung == 0 ? 0 : ($sum / $hitung);
            // dd($total);
        } else {
            $total = 0;
        }

        return view('user.siswa.nilai', compact('classes', 'nilai', 'semesters', 'student', 'total'));
    }

    // public function gradesStudent(Request $request)
    // {
    //     $classes = \App\ClassStudent::where('student_id', '=', auth()->user()->student->id)->get();
    //     // dd($classes);
    //     $semesters = \App\Semester::all();
    //     // $id = auth()->user()->student->id;

    //     $grades = \App\Grade::where('class_student_id', '=', $request->kelas)->where('semester_id', '=', $request->semester)->get();
    //     return view('user.siswa.nilai', compact('classes', 'semesters', 'grades'));
    // }
}

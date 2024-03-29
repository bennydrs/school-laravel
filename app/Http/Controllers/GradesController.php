<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class GradesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classes = \App\ClassRoom::all();
        $semesters = \App\Semester::all();

        $grades = Grade::where('class_room_id', $request->kelas)->where('semester_id', $request->semester)->get();

        $grades->map(function ($grade) {
            $jmltugas = $grade->nilai_tugas_1 + $grade->nilai_tugas_2;
            $rata2tugas = $jmltugas / 2;

            $tugas = $rata2tugas * 0.25;
            $uts = $grade->nilai_uts * 0.35;
            $uas = $grade->nilai_uas * 0.40;
            $rata2 = $tugas + $uts + $uas;
            $grade->rata2 = $rata2;
            return $grade;
        });

        return view('nilai.index', compact('classes', 'semesters', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($class_id, $semester_id, Request $request)
    {
        $id = $request->subject;

        $semester = \App\Semester::find($semester_id);
        $class = \App\ClassRoom::find($class_id);

        $schedule = \App\Schedule::where('class_room_id', $class_id)->where('semester_id', $semester_id)->get();
        // $teacher = \App\Schedule::where('teacher_id', '=', $request->teacher_id)->first();

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

            return view('nilai.create', compact('class', 'schedule', 'semester', 'students'));
        } else {
            return view('nilai.create', compact('class', 'schedule', 'semester'));
        }

        // $classLearns = \App\ClassLearn::where('class_room_id', '=', $class_id)->where('semester_id', '=', $semester_id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $cl = $request->class_learn_id;
        // $result_explode = explode(',', $cl);
        // echo "Model: " . $result_explode[0] . "<br />";
        // echo "Colour: " . $result_explode[1] . "<br />";
        // dd($result_explode[0]);
        $request->validate(
            [
                'nilai_tugas_1' => 'required',
            ],
            [
                'required' => 'field ini wajib diisi',
            ]
        );

        foreach ($request->class_student_id as $key => $value) {
            // dd($value);
            Grade::create([
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
        return redirect('grades?kelas=' . $request->class_room_id[$key] . '&semester=' . $request->semester_id[$key] . '')->with('status', 'Data nilai berhasil ditambah!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        $grade = Grade::find($grade->id);
        return view('nilai.edit', compact('grade'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        $grade = Grade::find($grade->id);
        $grade->update($request->all());
        $grade->save();
        return redirect('grades?kelas=' . $request->class_room_id . '&semester=' . $request->semester_id . '')->with('status', 'Data nilai berhasil diubah!');
    }
}

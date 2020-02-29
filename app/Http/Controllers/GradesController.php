<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;

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

        $grades = Grade::where('class_room_id', '=', $request->kelas)->where('semester_id', '=', $request->semester)->get();
        return view('nilai.index', compact('classes', 'semesters', 'grades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($class_id, $semester_id)
    {
        $semester = \App\Semester::find($semester_id);
        $class = \App\ClassRoom::find($class_id);
        $students = \App\Student::where('class_room_id', $class_id)->get();
        // $classLearns = \App\ClassLearn::where('class_room_id', '=', $class_id)->where('semester_id', '=', $semester_id)->get();
        // $classLearn = \App\ClassLearn::where('class_room_id', '=', $class_id)->where('semester_id', '=', $semester_id)->get();
        $classLearn = \App\Schedule::where('class_room_id', '=', $class_id)->where('semester_id', '=', $semester_id)->get();

        return view('nilai.create', compact('class', 'classLearn', 'semester', 'students'));
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

        foreach ($request->student_id as $key => $value) {
            // dd($value);
            Grade::create([
                'student_id' => $value,
                'class_learn_id' => $request->class_learn_id,
                'class_room_id' => $request->class_room_id[$key],
                'semester_id' => $request->semester_id[$key],
                'nilai_tugas_1' => $request->nilai_tugas_1[$key],
                'nilai_tugas_2' => $request->nilai_tugas_2[$key],
                'nilai_uts' => $request->nilai_uts[$key],
                'nilai_uas' => $request->nilai_uas[$key],
            ]);
        }
        return redirect('grades?kelas=' . $request->class_room_id[$key] . '&semester=' . $request->semester_id[$key] . '')->with('status', 'Data nilai berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        //
    }
}

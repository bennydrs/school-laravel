<?php

namespace App\Http\Controllers;

use App\HomeroomTeacher;
use Illuminate\Http\Request;

class HomeroomTeachersController extends Controller
{
    public function index(Request $request)
    {
        $semesters = \App\Semester::all();
        $homeroomTeachers = HomeroomTeacher::where('semester_id', $request->semester)->get();
        return view('wali_kelas.index', compact('semesters', 'homeroomTeachers'));
    }

    public function create($semester_id)
    {
        $classes = \App\ClassRoom::all();
        $semester = \App\Semester::find($semester_id);
        $teachers = \App\Teacher::all();
        return view('wali_kelas.create', compact('classes', 'semester', 'teachers'));
    }

    public function store(Request $request)
    {
        HomeroomTeacher::create($request->all());
        return redirect('/wali-kelas?semester=' . $request->semester_id)->with('status', 'Data wali kelas berhasil ditambah!');
    }

    public function destroy(HomeroomTeacher $homeroomTeacher)
    {
        HomeroomTeacher::destroy($homeroomTeacher->id);
        return redirect('/wali-kelas?semester=' . $homeroomTeacher->semester_id)->with('status', 'Data wali kelas berhasil ditambah!');
    }
}

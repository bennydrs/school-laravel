<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Admin
    public function index()
    {
        return view('user.admin.dashboard');
    }
    //end admin

    // siswa
    public function student()
    {
        $informations = Information::all()->take(3);
        $classes = \App\ClassStudent::where('student_id', '=', auth()->user()->student->id)->get();

        $sum = 0;
        // $nilai = DB::table('class_learns')
        //     ->leftJoin('subjects', 'subjects.id', '=', 'class_learns.subject_id')
        //     ->select('class_learns.*', 'grades.*', 'subjects.nama')
        //     ->leftJoin('grades', function ($leftJoin) {
        //         $leftJoin->on('grades.class_learn_id', '=', 'class_learns.id');
        //         // $leftJoin->where('grades.class_room_id', '=', 1);
        //         $leftJoin->groupBy('grades.semester_id');
        //         // $leftJoin->where('grades.semester_id', '=', $semester_id);
        //         $leftJoin->where('grades.class_student_id', '=', 1);
        //         // $leftJoin->on(DB::raw('grades.class_student_id'), DB::raw('='), DB::raw("'" . $class_student_id . "'"));
        //     })->get();

        $nilai = DB::table('grades as g')
            ->leftJoin('class_learns', 'g.class_learn_id', '=', 'class_learns.id')
            ->leftJoin('semesters', 'g.semester_id', '=', 'semesters.id')
            ->select(DB::raw('round(sum( ((g.nilai_tugas_1 + g.nilai_tugas_2) / 2 * 0.25) + (g.nilai_uts * 0.35) + (g.nilai_uas * 0.40) ) / count(class_learns.subject_id) ,2) as rata2, g.semester_id, class_learns.*, count(class_learns.subject_id) as jmlMapel, semesters.tahun_ajaran, semesters.semester'))
            ->where('g.class_student_id', '=', 1)
            ->groupBy('g.semester_id')
            ->get();

        // dd($nilai);
        // $jmltugas = [];
        // $semester = [];
        foreach ($nilai as $grade) {
            $semester[] = $grade->tahun_ajaran . ' | ' . $grade->semester;
            $rata2[] = $grade->rata2;
            $jmlMapel[] = $grade->jmlMapel;
            // $jmltugas[] = $grade->nilai_tugas_1 + $grade->nilai_tugas_1 / 2;
            // $rata2tugas = $jmltugas / 2;

            // $tugas = $rata2tugas * 25 / 100;
            // $uts = $grade->nilai_uts * 35 / 100;
            // $uas = $grade->nilai_uas * 40 / 100;
            // $rata2 = $tugas + $uts + $uas;

            // $sum += $rata2;
        }

        // $jumlahData = count($nilai->unique('subject_id'));

        // $rata = $sum / $jumlahData;

        // dd(json_encode($jmlMapel));

        return view('user.siswa.dashboard', compact('informations', 'semester', 'rata2', 'jmlMapel'));
    }

    public function showInformation($information_id)
    {
        $information = Information::find($information_id);
        return view('user.siswa.showInformation', compact('information'));
    }
    //end siswa

    // guru
    public function teacher()
    {
        return view('user.guru.dashboard');
    }
    // end guru
}

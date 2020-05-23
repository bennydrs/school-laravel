<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ExportsController extends Controller
{
    public function exportSiswaPDF()
    {
        $students = Student::all();
        $pdf = PDF::loadView('export.siswapdf', compact('students'));
        return $pdf->download('siswa.pdf');
    }

    public function exportJadwalPDF($kelas, $semester)
    {
        $schedule = \App\Schedule::where('class_room_id', '=', $kelas)->where('semester_id', '=', $semester)->orderByRaw("FIELD(hari, 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')")->get();

        $pdf = PDF::loadView('export.jadwalpdf', compact('schedule'));
        return $pdf->download('jadwal.pdf');
    }

    public function exportNilaiPDF($kelas, $semester)
    {
        $grades = \App\Grade::where('class_room_id', $kelas)->where('semester_id', $semester)->get();
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

        $pdf = PDF::loadView('export.nilaipdf', compact('grades'));
        return $pdf->download('nilai.pdf');
    }

    public function exportNilaiSiswaPDF($kelas, $semester)
    {
        $student = \App\ClassStudent::find($kelas);
        // $class_room_id = $student->class_room_id;

        $nilai = DB::table('class_learns')
            ->leftJoin('subjects', 'subjects.id', '=', 'class_learns.subject_id')
            ->select('class_learns.*', 'grades.*', 'grades.class_learn_id', 'subjects.nama')
            ->leftJoin('grades', function ($leftJoin) use ($kelas, $semester) {
                $leftJoin->on('grades.class_learn_id', '=', 'class_learns.id');
                // $leftJoin->where('grades.class_room_id', '=', $class_room_id);
                $leftJoin->where('grades.semester_id', '=', $semester);
                $leftJoin->where('grades.class_student_id', '=', $kelas);
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

        $total = 0;
        $hitung = 0;
        foreach ($nilai->unique('subject_id') as $n) {
            $total += $n->rata2;
            $hitung++;
        }
        $total = $total / $hitung;

        $pdf = PDF::loadView('export.nilai_siswa_pdf', compact('nilai', 'student', 'semester', 'total'));
        return $pdf->download('nilai-siswa.pdf');
    }
}

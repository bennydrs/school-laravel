<?php

namespace App\Http\Controllers;

use App\ClassLearn;
use App\Schedule;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{

    public function index(Request $request)
    {
        // dd(Input::get('kelas'));
        $classes = \App\ClassRoom::all();
        $semesters = \App\Semester::all();


        $schedule = Schedule::where('class_room_id', '=', $request->kelas)->where('semester_id', '=', $request->semester)->get();
        return view('jadwal.index', compact('classes', 'semesters', 'schedule'));
    }

    public function create($class_id, $semester_id)
    {
        $semester = \App\Semester::find($semester_id);
        $class = \App\ClassRoom::find($class_id);
        $classLearns = \App\ClassLearn::where('class_room_id', '=', $class_id)->where('semester_id', '=', $semester_id)->get();
        return view('jadwal.create', compact('class', 'classLearns', 'semester'));
    }

    // public function getSemester($semester_id = 0, $class_id) //untuk create
    // {
    //     $semesterCL = \App\ClassLearn::where("semester_id", '=', $semester_id)->where('class_room_id', '=', $class_id)->with('subject')->get();

    //     return response()->json($semesterCL);
    // }

    public function store(Request $request)
    {
        $request->validate(
            [
                'hari' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'class_learn_id' => 'required',
                'teacher_id' => 'required',
            ],
            [
                'required' => 'field ini wajib diisi',
            ]
        );

        $schedule = Schedule::where('hari', $request->hari)->where('jam_mulai', $request->jam_mulai)->where('class_learn_id', $request->class_learn_id)->first();

        $teacher = Schedule::where('hari', $request->hari)->where('jam_mulai', $request->jam_mulai)->where('teacher_id', $request->teacher_id)->first();

        if ($schedule != null) {
            return redirect('schedules/' . $request->class_room_id . '/create')->with('error', 'Data jadwal sudah ada!')->withInput();
        } else if ($teacher != null) {
            return redirect('schedules/' . $request->class_room_id . '/create')->with('error', 'Jadwal guru bentrok!')->withInput();
        } else if ($request->jam_mulai == $request->jam_selesai) {
            return redirect('schedules/' . $request->class_room_id . '/create')->with('error', 'Jam mulai & jam selesai tidak boleh sama!')->withInput();
        } else {
            Schedule::create($request->all());
            return redirect('schedules?kelas=' . $request->class_room_id . '&semester=' . $request->semester_id . '')->with('status', 'Data jadwal berhasil ditambah!');
        }
    }

    public function show(Schedule $schedule)
    {
        //
    }

    public function edit(Schedule $schedule)
    {
        $semester = \App\Semester::find($schedule->semester_id);
        $class = \App\ClassRoom::find($schedule->class_room_id);
        $classLearns = \App\ClassLearn::where('class_room_id', '=', $schedule->class_room_id)->where('semester_id', '=', $schedule->semester_id)->get();
        return view('jadwal.edit', compact('schedule', 'classLearns', 'semester', 'class'));
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate(
            [
                'hari' => 'required',
                'jam_mulai' => 'required',
                'jam_selesai' => 'required',
                'class_learn_id' => 'required',
                'teacher_id' => 'required',
            ],
            [
                'required' => 'field ini wajib diisi',
            ]
        );
        $cekSchedule = Schedule::where('hari', $request->hari)->where('jam_mulai', $request->jam_mulai)->where('class_learn_id', $request->class_learn_id)->first();

        $teacher = Schedule::where('hari', $request->hari)->where('jam_mulai', $request->jam_mulai)->where('teacher_id', $request->teacher_id)->first();

        if ($cekSchedule && $cekSchedule->id != $schedule->id) {
            return redirect('schedules/' . $schedule->id . '/edit')->with('error', 'Data jadwal sudah ada!')->withInput();
        } else if ($teacher && $teacher->teacher_id != $schedule->teacher->id) {
            return redirect('schedules/' . $schedule->id . '/edit')->with('error', 'Jadwal guru bentrok!')->withInput();
        } else if ($schedule->jam_mulai == $schedule->jam_selesai) {
            return redirect('schedules/' . $schedule->id . '/edit')->with('error', 'Jam mulai & jam selesai tidak boleh sama!')->withInput();
        } else {
            $schedule = Schedule::find($schedule->id);
            $schedule->update($request->all());
            $schedule->save();
            return redirect('schedules?kelas=' . $schedule->class_room_id . '&semester=' . $schedule->semester_id . '')->with('status', 'Data jadwal berhasil diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        Schedule::destroy($schedule->id);
        return redirect('schedules?kelas=' . $schedule->class_room_id . '&semester=' . $schedule->semester_id . '')->with('status', 'Data jadwal berhasil dihapus');
    }

    // public function scheduleClass($id)
    // {
    //     // $schedules = Schedule::where('class_room_id', '=', $id)->get();
    //     $class = \App\ClassRoom::find($id);
    //     return view('jadwal.jadwal_kelas', compact('class'));
    // }

    // public function getdataclass()
    // {
    //     $classRooms = \App\ClassRoom::select('class_rooms.*');
    //     return \DataTables::eloquent($classRooms)
    //         ->addIndexColumn()
    //         ->addColumn('wali', function ($c) {
    //             return $c->teacher->nama;
    //         })
    //         ->addColumn('aksi', function ($s) {
    //             return '<a href="/schedules/class/' . $s->id . '" class="btn btn-info btn-sm">jadwal</a> 
    //             ';
    //         })
    //         ->rawColumns(['aksi'])
    //         ->tojson();
    // }

    // dropdown filter
    // public function getCustomFilterDataSchedule(Request $request)
    // {
    //     $schedules = Schedule::select('schedules.*');

    //     return \DataTables::eloquent($schedules)
    //         ->addIndexColumn()
    //         ->filter(function ($query) use ($request) {

    //             if ($request->has('kelas')) {
    //                 $query->where('class_room_id', 'like', "%{$request->get('kelas')}%");
    //             }

    //             if ($request->has('semester')) {
    //                 $query->where('semester_id', 'like', "%{$request->get('semester')}%");
    //             }
    //         })
    //         // ->addIndexColumn()
    //         ->addColumn('mapel', function ($s) {
    //             return $s->classLearn->subject->nama;
    //         })
    //         ->addColumn('semester', function ($sd) {
    //             return $sd->classLearn->semester->semester . ' | ' . $sd->classLearn->semester->tahun_ajaran;
    //         })
    //         ->addColumn('guru', function ($sd) {
    //             return $sd->teacher->nama;
    //         })
    //         ->addColumn('aksi', function ($sd) {
    //             return '<a href="/schedules/class/' . $sd->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
    //             <form action="/schedules/class/' . $sd->id . '" method="post" class="d-inline delete">   
    //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                 <input type="hidden" name="_method" value="DELETE">
    //                 <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
    //             </form>';
    //         })

    //         // ->make(true);
    //         ->rawColumns(['mapel', 'semester', 'guru', 'aksi'])
    //         ->tojson();
    // }


    // public function getdataschedule($kelas_id, $semester_id)
    // {
    //     $schedule = Schedule::select('schedules.*')->where('class_room_id', '=', $kelas_id)->where('semester_id', '=', $semester_id);
    //     return \DataTables::eloquent($schedule)
    //         ->addIndexColumn()
    //         ->addColumn('mapel', function ($sd) {
    //             return $sd->classLearn->subject->nama;
    //         })
    //         ->addColumn('semester', function ($sd) {
    //             return $sd->classLearn->semester->semester . ' | ' . $sd->classLearn->semester->tahun_ajaran;
    //         })
    //         ->addColumn('guru', function ($sd) {
    //             return $sd->teacher->nama;
    //         })
    //         ->addColumn('aksi', function ($sd) {
    //             return '<a href="/schedules/class/' . $sd->id . '/edit" class="btn btn-warning btn-sm">edit</a> 
    //             <form action="/schedules/class/' . $sd->id . '" method="post" class="d-inline delete">   
    //                 <input type="hidden" name="_token" value="' . csrf_token() . '">
    //                 <input type="hidden" name="_method" value="DELETE">
    //                 <button type="submit" class="btn btn-danger delete btn-sm">hapus</button>
    //             </form>';
    //         })
    //         ->rawColumns(['mapel', 'semester', 'guru', 'aksi'])
    //         ->tojson();
    // }
}

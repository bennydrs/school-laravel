<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    table,
    td,
    th {
        border: 1px solid black;
    }

    td,
    th {
        padding: 10px;
    }
</style>

<center>
    <h3>Nilai</h3>
</center>


<p>Nama : {{$student->student->nama}}</p>
<p>NIS : {{$student->student->nis}}</p>
<p>Kelas : {{$student->classRoom->nama}}</p>
<p>Semester : {{ $student->semester->tahun_ajaran .' | '. $student->semester->semester}}</p>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Mata Pelajaran</th>
            <th>Nilai Tugas 1</th>
            <th>Nilai Tugas 2</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Nilai Rata2</th>
        </tr>
    </thead>

    <tbody>
        {{-- @php
        $sum = 0;
        @endphp --}}
        @foreach ($nilai->unique('subject_id') as $grade)
        {{-- @php
        $jmltugas = $grade->nilai_tugas_1 + $grade->nilai_tugas_2;
        $rata2tugas = $jmltugas / 2;

        $tugas = $rata2tugas * 0.25;
        $uts = $grade->nilai_uts * 0.35;
        $uas = $grade->nilai_uas * 0.40;
        $rata2 = $tugas + $uts + $uas;

        $sum += $rata2
        @endphp --}}
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                {{ isset($grade->nama) ? ucfirst($grade->nama) :
                        'no name!' }}
            </td>
            <td>
                {{ isset( $grade->nilai_tugas_1) ?  ucfirst($grade->nilai_tugas_1)  : '-' }}
            </td>
            <td>
                {{ isset($grade->nilai_tugas_2) ?  ucfirst($grade->nilai_tugas_2)  : '-' }}
            </td>
            <td>
                {{ isset($grade->nilai_uts) ?  ucfirst($grade->nilai_uts)  : '-' }}
            </td>
            <td>
                {{ isset($grade->nilai_uas) ?  ucfirst($grade->nilai_uas)  : '-' }}
            </td>
            <td>
                {{ (round($grade->rata2,2)) ? (round($grade->rata2,2))  : '-' }}
            </td>
        </tr>

        @endforeach
        <tr>
            <td colspan="6" class="text-center text-bold">Rata-rata</td>
            <td>
                {{ (round($total, 2)) ? (round($total, 2))  : '-'  }}
            </td>
        </tr>
        {{-- @php
        $ss = \App\Grade::where('class_student_id',$student->id)->where('semester_id',
        $semester)->get();

        $jm = count($ss);
        @endphp
        @php
        $jumlahData = count($nilai->unique('subject_id'));
        @endphp
        @if($ss->isNotEmpty())
        <tr>
            <td colspan="6" class="text-center text-bold">Rata-rata</td>
            <td>
                {{ (round($sum / $jm, 2)) ? (round($sum / $jm, 2))  : '-'  }}
        </td>
        </tr>
        @endif --}}
    </tbody>
</table>
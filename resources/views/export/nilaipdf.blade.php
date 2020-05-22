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
</style>
<center>
    <h3>Nilai Siswa Kelas {{$grades[0]->classStudent->classRoom->nama}} Semester
        {{$grades[0]->semester->tahun_ajaran .' | '. $grades[0]->semester->semester }}</h3>
</center>
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>Nama</th>
            <th>Mata Pelajaran</th>
            <th>Nilai Tugas 1</th>
            <th>Nilai Tugas 2</th>
            <th>Nilai UTS</th>
            <th>Nilai UAS</th>
            <th>Rata2</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $grade->classStudent->student->nama }}</td>
            <td>{{ $grade->classLearn->subject->nama }}</td>
            <td>{{ $grade->nilai_tugas_1 }}</td>
            <td>{{ $grade->nilai_tugas_2 }}</td>
            <td>{{ $grade->nilai_uts }}</td>
            <td>{{ $grade->nilai_uas }}</td>
            <td>{{ round($grade->rata2, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
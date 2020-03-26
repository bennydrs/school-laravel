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
    <h3>Data Siswa</h3>
</center>
<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Tempat Tanggal Lahir</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>Agama</th>
        </tr>
    </thead>
    <tbody>
        @foreach($students as $student)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $student->nis }}</td>
            <td>{{ $student->nama }}</td>
            <td>{{ $student->tempat_tanggal_lahir() }}</td>
            <td>{{ $student->jenis_kelamin }}</td>
            <td>{{ $student->alamat }}</td>
            <td>{{ $student->agama }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
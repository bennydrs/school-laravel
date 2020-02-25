@extends('layouts/master')

@section('title', 'Jadwal')
@section('header', 'Data Jadwal')

@section('content')

<div class="row">
    <div class="col-lg-12">

        <a href="{{ $class->id }}/create" class="btn btn-primary mb-3 coba">Tambah Jadwal</a>
        <a href="/schedules" class="btn btn-warning mb-3">Kembali</a>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Data Jadwal Kelas {{ $class->nama }}
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Semester</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- <tr>
                            @foreach ($schedules as $schedule)
                            <td>{{$schedule->hari}}</td>
                        <td>{{$schedule->jam_mulai}}</td>
                        <td>{{$schedule->jam_selesai}}</td>
                        <td>{{$schedule->classLearn->subject->nama}}</td>
                        <td>{{$schedule->teacher->nama}}</td>
                        <td>{{$schedule->classLearn->semester->semester .' | '. $schedule->classLearn->semester->tahun_ajaran}}
                        </td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        
            $('#datatable').DataTable({
                processing: true,
                serverside: true,
                ajax: "/getdataschedule/{{$class->id}}",
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {data: 'hari', name: 'hari'},
                    {data: 'jam_mulai', name: 'jam_mulai'},
                    {data: 'jam_selesai', name: 'jam_selesai'},
                    {data: 'mapel', name: 'mapel'},
                    {data: 'guru', name: 'guru'},
                    {data: 'semester', name: 'semester'},
                    {data: 'aksi', name: 'aksi'},
                ]
            });

            $('#datatable').on('click', '.delete', function(e) {

                e.preventDefault();
                const form = $(this).attr('action');

                Swal.fire({
                    title: 'Apa kamu yakin?',
                    text: "Data kelas ini akan hilang!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.value) {
                        $('.delete').submit();
                    }
                })
            });
        });
</script>
@endsection
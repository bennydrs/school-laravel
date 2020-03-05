@extends('layouts/master')

@section('title', 'Kelas')
@section('header', 'Data Kelas')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <a href="class-rooms/create" class="btn btn-primary mb-3 coba">Tambah Kelas</a>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Data Kelas
                </div>
            </div>
            <div class="card-body">
                <table class="table" id="datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Kelas</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{{ $student->nama }}</td>
                        <td>{{ $student->jenis_kelamin }}</td>
                        <td>
                            <a href="/students/{{ $student->id }}" class="btn btn-info btn-sm">detail</a>
                            <a href="/students/{{ $student->id }}/edit" class="btn btn-warning btn-sm">edit</a>
                            <form action="/students/{{$student->id}}" method="post" class="d-inline delete">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                            </form>
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
                ajax: "{{ route('ajax.get.data.class') }}",
                columns:[
                    { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                    {data: 'kode_kelas', name: 'kode_kelas'},
                    {data: 'nama', name: 'nama'},
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
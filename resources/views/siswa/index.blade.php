@extends('layouts/master')

@section('title', 'Siswa')
@section('header', 'Data Siswa')

@section('content')

<div class="row">
   <div class="col-md-12">
      <a href="students/create" class="btn btn-primary mb-3 coba">Tambah Siswa</a>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Siswa
            </div>
         </div>
         <div class="card-body">
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>NIS</th>
                     <th>Nama</th>
                     <th>Jenis Kelamin</th>
                     <th>Alamat</th>
                     <th>Kelas</th>
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
         ajax: "{{ route('ajax.get.data.student') }}",
         columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'nis', name: 'nis'},
            {data: 'nama', name: 'nama'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'alamat', name: 'alamat'},
            {data: 'kelas', name: 'kelas'},
            {data: 'aksi', name: 'aksi'},
         ]
      });

      $('#datatable').on('click', '.delete', function(e) {

         e.preventDefault();
         const form = $(this).attr('action');

         Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data siswa dan user ini akan hilang!",
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
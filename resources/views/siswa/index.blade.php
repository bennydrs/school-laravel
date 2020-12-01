@extends('layouts/master')

@section('title', 'Siswa')
@section('header', 'Data Siswa')

@section('content')

<div class="row">
   <div class="col-md-12">
      <a href="/students/create" class="btn btn-primary mb-3 coba load">Tambah Siswa</a>
      <a href="/export-siswa-pdf" class="btn btn-primary mb-3">Export PDF</a>
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
                     <th>Aksi</th>
                  </tr>
               </thead>
               <tbody>

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
            // {data: 'kelas', name: 'kelas'},
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
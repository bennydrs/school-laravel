@extends('layouts/master')

@section('title', 'Mata Pelajaran')
@section('header', 'Data Mata Pelajaran')

@section('content')

<div class="row">
   <div class="col-md-8">
      <a href="subjects/create" class="btn btn-primary mb-3 coba">Tambah Mata Pelajaran</a>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Mata Pelajaran
            </div>
         </div>
         <div class="card-body">
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Kode Mata Pelajaran</th>
                     <th>Nama</th>
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
         ajax: "{{ route('ajax.get.data.subject') }}",
         columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'kode_mapel', name: 'kode_mapel'},
            {data: 'nama', name: 'nama'},
            {data: 'aksi', name: 'aksi'},
         ]
      });

      $('#datatable').on('click', '.delete', function(e) {
         e.preventDefault();
         const form = $(this).attr('action');

         Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data mapel ini akan hilang!",
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
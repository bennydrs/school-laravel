@extends('layouts/master')

@section('title', 'Admin')
@section('header', 'Data Admin')

@section('content')

<div class="row">
   <div class="col-md-12">
      <a href="admins/create" class="btn btn-primary mb-3 coba">Tambah Admin</a>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Admin
            </div>
         </div>
         <div class="card-body">
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>NIP</th>
                     <th>Nama</th>
                     <th>Jenis Kelamin</th>
                     <th>No Telepon</th>
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
         ajax: "{{ route('ajax.get.data.admin') }}",
         columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'nip', name: 'nip'},
            {data: 'nama', name: 'nama'},
            {data: 'jenis_kelamin', name: 'jenis_kelamin'},
            {data: 'telp', name: 'telp'},
            {data: 'alamat', name: 'alamat'},
            {data: 'aksi',  name: 'aksi'},
         ]
      })

      $('#datatable').on('click', '.delete', function(e) {
         e.preventDefault();
         const form = $(this).attr('action');

         Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data admin dan user ini akan hilang!",
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
@extends('layouts/master')

@section('title', 'Semester')
@section('header', 'Data Semester')

@section('content')

<div class="row">
   <div class="col-md-8">
      <a href="semesters/create" class="btn btn-primary mb-3 coba">Tambah Semester</a>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Semester
            </div>
         </div>
         <div class="card-body">
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Kode Semester</th>
                     <th>Semester</th>
                     <th>Tahun Ajaran</th>
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
         ajax: "{{ route('ajax.get.data.semester') }}",
         columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'kode_semester', name: 'kode_semester'},
            {data: 'semester', name: 'semester'},
            {data: 'tahun_ajaran', name: 'tahun_ajaran'},
            {data: 'aksi', name: 'aksi'},
         ]
      });

      $('#datatable').on('click', '.delete', function(e) {
         e.preventDefault();
         const form = $(this).attr('action');

         Swal.fire({
            title: 'Apa kamu yakin?',
            text: "Data semester ini akan hilang!",
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
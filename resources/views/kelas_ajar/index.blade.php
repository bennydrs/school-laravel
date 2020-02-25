@extends('layouts/master')

@section('title', 'Kelas Ajar')
@section('header', 'Data Kelas Ajar')

@section('content')

<div class="row">
   <div class="col-md-8">
      <a href="class-learns/create" class="btn btn-primary mb-3 coba">Tambah Kelas Ajar</a>
      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Kelas Ajar
            </div>
         </div>
         <div class="card-body">
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     {{-- <th>Kode Kelas Ajar</th> --}}
                     <th>Kelas</th>
                     <th>Semester</th>
                     <th>Tahun Ajaran</th>
                     <th>Mata Pelajaran</th>
                     {{-- <th>Pengajar</th> --}}
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
         ajax: "{{ route('ajax.get.data.classLearn') }}",
         columns:[
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            // {data: 'kode_kelas', name: 'kode_kelas'},
            {data: 'kelas', name: 'kelas'},
            {data: 'semester', name: 'semester'},
            {data: 'tahun', name: 'tahun'},
            {data: 'mapel', name: 'mapel'},
            // {data: 'pengajar', name: 'pengajar'},
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
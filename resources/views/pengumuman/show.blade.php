@extends('layouts/master')

@section('title', 'Pengumuman')
@section('header', 'Detail Pengumuman')

@section('content')

<a href="/informations" class="btn btn-info btn-sm mb-3">Kembali</a>
<div class="row">
   <div class="col-md-12">
      <div class="callout callout-info">
         <h5>{{$information->judul}}</h5>
         <span class="mailbox-read-time">{{ $information->created_at->format('d M Y') }}</span>

         <p>{!!$information->konten!!}</p>
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
         ajax: "{{ route('ajax.get.data.information') }}",
         columns:[
            {data: 'DT_RowIndex', name: 'DT_RowIndex' },
            {data: 'judul', name: 'judul'},
            // {data: 'konten', name: 'konten'},
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
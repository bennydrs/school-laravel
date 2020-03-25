@extends('layouts/master')

@section('title', 'Ubah Kelas')
@section('header', 'Ubah Data Kelas')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">Ubah Data Kelas</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form method="post" action="/class-rooms/{{$classRoom->id}}" role="form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
               <div class="form-group">
                  <label for="kode_kelas">Kode Kelas</label>
                  <input type="text" name="kode_kelas" class="form-control" id="kode_kelas"
                     value="{{ $classRoom->kode_kelas }}" readonly>
               </div>

               <div class="form-group">
                  <label for="nama">Nama Kelas</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                     value="{{ $classRoom->nama }}">
                  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
               <button type="submit" class="btn btn-primary">Ubah Data</button>
               <a href="/class-rooms" class="btn btn-warning">Batal</a>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
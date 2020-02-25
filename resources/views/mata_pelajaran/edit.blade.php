@extends('layouts/master')

@section('title', 'Ubah Mata Pelajaran')
@section('header', 'Ubah Data Mata Pelajaran')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Ubah Data Mata Pelajaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="/subjects/{{$subject->id}}" role="form" enctype="multipart/form-data">
                @csrf
                @method('put')
              <div class="card-body">
                <div class="form-group">
                    <label for="kode_mapel">Kode Mata Pelajaran</label>
                    <input type="text" name="kode_mapel" class="form-control" id="kode_mapel" value="{{ $subject->kode_mapel }}" readonly>
                </div>

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ $subject->nama }}">
                  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
               
           
              </div>
              <!-- /.card-body -->
        
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah Data</button>
                <a href="/subjects" class="btn btn-warning">Batal</a>
              </div>
            </form>
          </div>
    </div>
</div>  


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
 
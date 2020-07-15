@extends('layouts/master')

@section('title', 'Tambah Mata Pelajaran')
@section('header', 'Tambah Data Mata Pelajaran')

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Input Data Mata Pelajaran</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      @php
      $default = 100;
      $kodeAngka = substr($kodeTerakhir, 3);
      $kodeMataPelajaran = $default + $kodeAngka +1;
      @endphp

      <form method="post" action="/subjects" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="kode_mapel">Kode Mata Pelajaran</label>
            <input type="text" name="kode_mapel" class="form-control @error('kode_mapel') is-invalid @enderror"
              id="kode_mapel" placeholder="Masukkan kode_mapel" value="{{ 'MP'.$kodeMataPelajaran }}" readonly>
            @error('kode_mapel') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="nama">Nama Mata Pelajaran</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
              placeholder="Masukkan nama" value="{{ old('nama') }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Tambah Data</button>
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
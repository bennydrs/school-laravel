@extends('layouts/master')

@section('title', 'Tambah Pengumuman')
@section('header', 'Tambah Data Pengumuman')

@section('style')
<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.css')}}">
@endsection

@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Input Data Pengumuman</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->

      <form method="post" action="/informations" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul"
              placeholder="Masukkan judul" value="{{ @old('judul') }}">
            @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="textarea form-control @error('konten') is-invalid @enderror"
              name="konten">{{ old('konten') }}</textarea>
            @error('konten') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="publish" name="publish" value="1">
            <label class="custom-control-label" for="publish">Publish?</label>
          </div>

          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Tambah Data</button>
          <a href="/informations" class="btn btn-warning">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection
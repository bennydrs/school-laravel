@extends('layouts/master')

@section('title', 'Ubah Semester')
@section('header', 'Ubah Data Semester')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Input Data Semester</h3>
            </div>
            <!-- /.card-header -->

            <form method="post" action="/semesters/{{ $semester->id }}">
                @csrf
                @method('put')
              <div class="card-body">

                <div class="form-group">
                  <label for="semester">Semester</label>
                  <select name="semester" id="semester" class="form-control custom-select @error('semester') is-invalid @enderror">
                    <option value="">Pilih semester</option>
                    <option value="Genap" {{ $semester->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                    <option value="Ganjil" {{ $semester->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                  </select>
                  @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="nama">Tahun Ajaran</label>
                  <input type="text" name="tahun_ajaran" class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" placeholder="Masukkan tahun ajaran" data-inputmask="'mask': ['9999/9999']" data-mask="" im-insert="true" value="{{ $semester->tahun_ajaran }}">
                  @error('tahun_ajaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

              </div>
              <!-- /.card-body -->
        
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Ubah Data</button>
                <a href="/semesters" class="btn btn-warning">Batal</a>
              </div>
            </form>
          </div>
    </div>
</div>  


@endsection

@section('script')
<script src="{{ asset('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
      $('[data-mask]').inputmask()
    </script>

@endsection
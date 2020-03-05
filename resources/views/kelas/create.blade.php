@extends('layouts/master')

@section('title', 'Tambah Kelas')
@section('header', 'Tambah Data Kelas')

@section('content')

<div class="row">
  <div class="col-md-6">
    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Input Data Kelas</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      @php
      $default = 100;
      $kodeAngka = substr($kodeTerakhir, 2);
      $kodeKelas = $default + $kodeAngka +1;
      @endphp

      <form method="post" action="/class-rooms" role="form" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
          <div class="form-group">
            <label for="kode_kelas">Kode Kelas</label>
            <input type="text" name="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror"
              id="kode_kelas" placeholder="Masukkan kode_kelas" value="{{ 'K'.$kodeKelas }}" readonly>
            @error('kode_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group">
            <label for="nama">Nama Kelas</label>
            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
              placeholder="Masukkan nama" value="{{ old('nama') }}">
            @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          {{-- <div class="form-group">
                  <label for="teacher_id">Wali Kelas</label>
                  <select class="form-control custom-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id">
                    <option value="" selected="" disabled="">Pilih wali kelas</option>
                    @foreach ($teachers as $teacher)
                    @php
                        $id = \App\ClassRoom::where('teacher_id', '=', $teacher->id)->first()
                    @endphp
                    @if (is_null($id))
                    <option value="{{$teacher->id}}"
          {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{$teacher->nama}}</option>
          @endif
          @endforeach
          </select>
          @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div> --}}



    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tambah Data</button>
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
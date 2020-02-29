@extends('layouts/master')

@section('title', 'Tambah Kelas Ajar')
@section('header', 'Tambah Data Kelas Ajar')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-warning">
         <div class="card-header">
            <h3 class="card-title">Input Data Kelas Ajar</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         {{-- @php
              $default = 100;
              $kodeAngka = substr($kodeTerakhir, 2);
              $kodeKelas = $default + $kodeAngka +1;
            @endphp --}}

         <form method="post" action="/class-learns" role="form">
            @csrf
            <div class="card-body">
               {{-- <div class="form-group">
                  <label for="kode_kelas">Kode Kelas</label>
                <input type="text" name="kode_kelas" class="form-control @error('kode_kelas') is-invalid @enderror" id="kode_kelas" placeholder="Masukkan kode_kelas" value="{{ 'K'.$kodeKelas }}"
               readonly>
               @error('kode_kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            <div class="form-group">
               <label for="class_room_id">Kelas</label>
               <select class="form-control custom-select @error('class_room_id') is-invalid @enderror"
                  id="class_room_id" name="class_room_id">
                  <option value="" selected="" disabled="">Pilih kelas</option>
                  @foreach ($classes as $class)
                  <option value="{{ $class->id }}" {{ old('class_room_id') == $class->id ? 'selected' : '' }}>
                     {{$class->nama}}
                  </option>
                  @endforeach
               </select>
               @error('class_room_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- <div class="form-group">
                  <label for="semester">Semester</label>
                  <select class="form-control custom-select @error('semester_id') is-invalid @enderror" id="semester_id" name="semester_id">
                    <option value="" selected="" disabled="">Pilih semester</option>
                    @foreach ($semesters as $semester)
                      <option value="{{$semester->id}}"
            {{ old('semester_id') == $semester->id ? 'selected' : '' }}>{{ $semester->semester .' | '. $semester->tahun_ajaran}}
            </option>
            @endforeach
            </select>
            @error('semester_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div> --}}

      <div class="form-group">
         <label for="subject_id">Mata Pelajaran</label>
         <select class="form-control custom-select @error('subject_id') is-invalid @enderror" id="subject_id"
            name="subject_id">
            <option value="" selected="" disabled="">Pilih mata pelajaran</option>
            @foreach ($subjects as $subject)
            <option value="{{$subject->id}}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
               {{$subject->nama}}
            </option>
            @endforeach
         </select>
         @error('subject_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      {{-- <div class="form-group">
                  <label for="teacher_id">Pengajar</label>
                  <select class="form-control custom-select @error('teacher_id') is-invalid @enderror" id="teacher_id" name="teacher_id">
                    <option value="" selected="" disabled="">Pilih pengajar</option>
                    @foreach ($teachers as $teacher)
                      <option value="{{$teacher->id}}"
      {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
      @endforeach
      </select>
      @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
   </div> --}}


</div>
<!-- /.card-body -->

<div class="card-footer">
   <button type="submit" class="btn btn-primary">Tambah Data</button>
   <a href="/class-learns" class="btn btn-warning">Batal</a>
</div>
</form>
</div>
</div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
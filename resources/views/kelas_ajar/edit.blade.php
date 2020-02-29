@extends('layouts/master')

@section('title', 'Ubah Kelas Ajar')
@section('header', 'Ubah Data Kelas Ajar')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">Ubah Data Kelas Ajar</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form method="post" action="/class-learns/{{$classLearn->id}}" role="form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">

               <div class="form-group">
                  <label for="class_room_id">Kelas</label>
                  <select class="form-control custom-select @error('class_room_id') is-invalid @enderror"
                     id="class_room_id" name="class_room_id">
                     <option value="" selected="" disabled="">Pilih kelas</option>
                     @foreach ($classes as $class)
                     <option value="{{ $class->id }}" {{ $classLearn->class_room_id == $class->id ? 'selected' : '' }}>
                        {{$class->nama}}</option>
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
               {{ $classLearn->semester_id == $semester->id ? 'selected' : '' }}>{{ $semester->semester .' | '. $semester->tahun_ajaran}}
               </option>
               @endforeach
               </select>
               @error('semester_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            <div class="form-group">
               <label for="subject_id">Mata Pelajaran</label>
               <select class="form-control custom-select @error('subject_id') is-invalid @enderror" id="subject_id"
                  name="subject_id">
                  <option value="" selected="" disabled="">Pilih pengajar</option>
                  @foreach ($subjects as $subject)
                  <option value="{{$subject->id}}" {{ $classLearn->subject_id == $subject->id ? 'selected' : '' }}>
                     {{$subject->nama}}</option>
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
            {{ $classLearn->teacher_id == $teacher->id ? 'selected' : '' }}>{{ $teacher->nama }}</option>
            @endforeach
            </select>
            @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div> --}}

   </div>
   <!-- /.card-body -->

   <div class="card-footer">
      <button type="submit" class="btn btn-primary">Ubah Data</button>
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
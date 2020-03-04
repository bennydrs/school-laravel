@extends('layouts/master')

@section('title', 'Tambah Wali Kelas')
@section('header', 'Tambah Data Wali Kelas')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-danger">
         <div class="card-header">
            <h3 class="card-title">Input Data wali kelas</h3>
         </div>

         <form method="post" action="/wali-kelas" role="form">
            @csrf
            <div class="card-body">

               <input type="hidden" name="semester_id" value="{{$semester->id}}">
               <div class="form-group">
                  <label for="class_room_id">Kelas</label>
                  <select class="form-control custom-select @error('class_room_id') is-invalid @enderror"
                     id="class_room_id" name="class_room_id">
                     <option value="" selected="" disabled="">Pilih kelas</option>
                     @foreach ($classes as $class)
                     @php
                     $id = \App\HomeroomTeacher::where('class_room_id', '=', $class->id)->where('semester_id',
                     $semester->id)->first()
                     @endphp
                     @if (is_null($id))
                     <option value="{{ $class->id }}" {{ old('class_room_id') == $class->id ? 'selected' : '' }}>
                        {{$class->nama}}
                     </option>
                     @endif
                     @endforeach
                  </select>
                  @error('class_room_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="teacher_id">Wali Kelas</label>
                  <select class="form-control custom-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                     name="teacher_id">
                     <option value="" selected="" disabled="">Pilih wali kelas</option>
                     @foreach ($teachers as $teacher)

                     @php
                     $id = \App\HomeroomTeacher::where('teacher_id', '=', $teacher->id)->where('semester_id',
                     $semester->id)->first()
                     @endphp
                     @if (is_null($id))
                     <option value="{{$teacher->id}}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{$teacher->nama}}</option>
                     @endif

                     @endforeach
                  </select>
                  @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
               <button type="submit" class="btn btn-primary">Tambah Data</button>
               <a href="/wali-kelas?semester={{$semester->id}}" class="btn btn-warning">Batal</a>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
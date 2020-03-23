@extends('layouts/master')

@section('title', 'Tambah Jadwal Kelas')
@section('header', 'Tambah Data Jadwal Kelas')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-warning">
         <div class="card-header">
            <h3 class="card-title">Input Data Jadwal Kelas {{ $classStudent->classRoom->nama }}</h3>
         </div>

         <form method="post" action="/schedules" role="form">
            @csrf
            <div class="card-body">
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="kode_kelas">Kode Kelas</label>
                     <input type="text" class="form-control" id="kode_kelas"
                        value="{{ $classStudent->classRoom->kode_kelas }}" readonly>
                  </div>
                  <div class="form-group col-md-6">
                     <label for="nama_kelas">Nama Kelas</label>
                     <input type="text" class="form-control" id="nama_kelas"
                        value="{{ $classStudent->classRoom->nama }}" readonly>
                  </div>
               </div>

               <div class="form-group">
                  <label for="semester">Semester</label>
                  <input type="text" class="form-control" id="semester"
                     value="{{ $semester->tahun_ajaran .' | '. $semester->semester }}" disabled>
               </div>

               <div class="form-group">
                  <label for="hari">Hari</label>
                  <select class="form-control custom-select @error('hari') is-invalid @enderror" id="hari" name="hari">
                     <option value="" selected="" disabled="">Pilih hari...</option>
                     <option value="Senin" {{ old('hari') == 'Senin' ? 'selected' : '' }}>Senin</option>
                     <option value="Selasa" {{ old('hari') == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                     <option value="Rabu" {{ old('hari') == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                     <option value="Kamis" {{ old('hari') == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                     <option value="Jumat" {{ old('hari') == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                     <option value="Sabtu" {{ old('hari') == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                  </select>
                  @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="jam_mulai">Jam Mulai</label>
                  <input type="text" name="jam_mulai" id="jam_mulai"
                     class="form-control jam @error('jam_mulai') is-invalid @enderror" value="{{ old('jam_mulai') }}">
                  @error('jam_mulai') <div class=" invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="jam_selesai">Jam Selesai</label>
                  <input type="text" name="jam_selesai" id="jam_selesai"
                     class="form-control jam @error('jam_selesai') is-invalid @enderror"
                     value="{{ old('jam_selesai') }}">
                  @error('jam_selesai') <div class=" invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <input type="text" name="class_room_id" class="class_id" value="{{ $classStudent->class_room_id }}">
               <input type="hidden" name="semester_id" value="{{ $semester->id }}">

               <div class="form-group">
                  <label for="class_learn_id">Mata Pelajaran</label>
                  <select name="class_learn_id"
                     class="form-control custom-select @error('class_learn_id') is-invalid @enderror"
                     id="class_learn_id">
                     <option value="" selected="" disabled="">Pilih mata pelajaran...</option>
                     @foreach ($classLearns as $cl)
                     <option value="{{ $cl->id }}" {{ old('class_learn_id' == $cl->id ? 'selected' : '') }}>
                        {{ $cl->subject->nama }}</option>
                     @endforeach
                  </select>
                  @error('class_learn_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               {{-- <div class="form-group">
                  <label for="semester">Semester</label>
                  <select name="semester_id" class="form-control custom-select @error('semester') is-invalid @enderror"
                     id="semester">
                     <option value="" selected="" disabled="">Pilih Semester</option>
                     @foreach ($semesters as $value)
                     <option value="{{ $value->id }}">
               {{ $value->semester .' | '. $value->tahun_ajaran }}</option>
               @endforeach
               </select>
               @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
               <label for="class_learn_id">Mata Pelajaran</label>
               <select name="class_learn_id"
                  class="form-control custom-select @error('class_learn_id') is-invalid @enderror" id="class_learn_id">
               </select>
               @error('class_learn_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div> --}}

            <div class="form-group">
               <label for="teacher_id">Guru</label>
               <select class="form-control custom-select @error('teacher_id') is-invalid @enderror" id="teacher_id"
                  name="teacher_id">
                  <option value="" selected="" disabled="">Pilih guru...</option>
                  @php
                  $teachers = \App\Teacher::all();
                  @endphp
                  @foreach ($teachers as $teacher)
                  <option value="{{$teacher->id}}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                     {{$teacher->nama}}
                  </option>
                  @endforeach
               </select>
               @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>


      </div>
      <!-- /.card-body -->

      <div class="card-footer">
         <button type="submit" class="btn btn-primary">Tambah Data</button>
         <a href="/schedules?kelas={{$classStudent->id}}&semester={{$semester->id}}" class="btn btn-warning">Batal</a>
      </div>
      </form>
   </div>
</div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
{{-- <script type='text/javascript'>
   $(document).ready(function ($) {
      $('select[name=semester_id]').on('change', function () {
      var classId = $(".class_id").attr('value');
      var selected = $(this).find(":selected").attr('value');
         console.log(classId)
      $.ajax({
         url:'/getSemester/'+selected+'/'+classId,
         type: 'GET',
         dataType: 'json',
            }).done(function (data) {
               
               var select = $('select[name=class_learn_id]');
               select.empty();
               select.append('<option value="0" >Pilih mata pelajaran</option>');
               $.each(data,function(key, value) {
               select.append('<option value=' + value.id + '>' + value.subject.nama + '</option>');
            });
               // console.log("success");
         })
      });
   });


  
</script> --}}
@endsection
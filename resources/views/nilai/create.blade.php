@extends('layouts/master')

@section('title', 'Tambah Nilai')
@section('header', 'Tambah Data Nilai')

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">Input Data Nilai {{ $class->nama }}</h3>
         </div>

         <form method="post" action="/grades" role="form">
            @csrf
            <div class="card-body">
               {{-- <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="kode_kelas">Kode Kelas</label>
                     <input type="text" class="form-control" id="kode_kelas" value="{{ $class->kode_kelas }}" readonly>
            </div>
            <div class="form-group col-md-6">
               <label for="nama_kelas">Nama Kelas</label>
               <input type="text" class="form-control" id="nama_kelas" value="{{ $class->nama }}" readonly>
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
            class="form-control jam @error('jam_selesai') is-invalid @enderror" value="{{ old('jam_selesai') }}">
         @error('jam_selesai') <div class=" invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <input type="hidden" name="class_room_id" class="class_id" value="{{ $class->id }}">
      <input type="hidden" name="semester_id" value="{{ $semester->id }}">

      <div class="form-group">
         <label for="class_learn_id">Mata Pelajaran</label>
         <select name="class_learn_id" class="form-control custom-select @error('class_learn_id') is-invalid @enderror"
            id="class_learn_id">
            <option value="" selected="" disabled="">Pilih mata pelajaran...</option>
            @foreach ($classLearns as $cl)
            <option value="{{ $cl->id }}" {{ old('class_learn_id' == $cl->id ? 'selected' : '') }}>
               {{ $cl->subject->nama }}</option>
            @endforeach
         </select>
         @error('class_learn_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>


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
      </div> --}}

      <select name="class_learn_id" id="">
         @foreach ($classLearn->unique('class_learn_id') as $cl)
         <option value="{{ $cl->class_learn_id }}">
            {{ $cl->classLearn->subject->nama}}</option>
         @endforeach
      </select>

      <table class="table">
         <thead>
            <tr>
               <th>No</th>
               <th>Nama</th>
               <th>Nilai Tugas 1</th>
               <th>Nilai Tugas 2</th>
               <th>Nilai UTS</th>
               <th>Nilai UAS</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($students as $student)
            <tr>
               <td>{{ $loop->iteration }}</td>
               <input type="hidden" class="form-control" name="class_room_id[]" value="{{$class->id}}">
               <input type="hidden" class="form-control" name="semester_id[]" value="{{$semester->id}}">
               <input type="hidden" class="form-control" name="student_id[]" value="{{$student->id}}">
               <td>{{ $student->nama }}</td>
               {{-- <td><input type="text" class="form-control" name="class_learn_id[]" value="{{$classLearn->id}}">
               --}}
               </td>
               <td><input type="number" class="form-control" name="nilai_tugas_1[]"></td>
               <td><input type="number" class="form-control" name="nilai_tugas_2[]"></td>
               <td><input type="number" class="form-control" name="nilai_uts[]"></td>
               <td><input type="number" class="form-control" name="nilai_uas[]"></td>
            </tr>
            @endforeach
         </tbody>
      </table>

   </div>
   <!-- /.card-body -->

   <div class="card-footer">
      <button type="submit" class="btn btn-primary">Tambah Data</button>
      <a href="/grades?kelas={{$class->id}}&semester={{$semester->id}}" class="btn btn-warning">Batal</a>
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
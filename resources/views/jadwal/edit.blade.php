@extends('layouts/master')

@section('title', 'Edit Jadwal Kelas')
@section('header', 'Edit Data Jadwal Kelas')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-success">
         <div class="card-header">
            <h3 class="card-title">Ubah Data Jadwal Kelas {{ $classStudent->classRoom->nama }}</h3>
         </div>

         <form method="post" action="/schedules/{{$schedule->id}}" role="form">
            @csrf
            @method('put')
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
                     <option value="Senin" {{ $schedule->hari == 'Senin' ? 'selected' : '' }}>Senin</option>
                     <option value="Selasa" {{ $schedule->hari == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                     <option value="Rabu" {{ $schedule->hari == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                     <option value="Kamis" {{ $schedule->hari == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                     <option value="Jumat" {{ $schedule->hari == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                     <option value="Sabtu" {{ $schedule->hari == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                  </select>
                  @error('hari') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="jam_mulai">Jam Mulai</label>
                  <input type="text" name="jam_mulai" id="jam_mulai"
                     class="form-control jam @error('jam_mulai') is-invalid @enderror"
                     value="{{ $schedule->jam_mulai }}">
                  @error('jam_mulai') <div class=" invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="jam_selesai">Jam Selesai</label>
                  <input type="text" name="jam_selesai" id="jam_selesai"
                     class="form-control jam @error('jam_selesai') is-invalid @enderror"
                     value="{{ $schedule->jam_selesai }}">
                  @error('jam_selesai') <div class=" invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <input type="hidden" name="class_room_id" class="class_id" value="{{ $schedule->class_room_id }}">
               <input type="hidden" name="semester_id" value="{{ $schedule->semester_id }}">

               <div class="form-group">
                  <label for="class_learn_id">Mata Pelajaran</label>
                  <select name="class_learn_id"
                     class="form-control custom-select @error('class_learn_id') is-invalid @enderror"
                     id="class_learn_id">
                     <option value="" selected="" disabled="">Pilih mata pelajaran...</option>
                     @foreach ($classLearns as $cl)
                     <option value="{{ $cl->id }}" {{ $schedule->class_learn_id == $cl->id ? 'selected' : '' }}>
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
                     <option value="{{$teacher->id}}" {{ $schedule->teacher_id == $teacher->id ? 'selected' : '' }}>
                        {{$teacher->nama}}
                     </option>
                     @endforeach
                  </select>
                  @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
               <button type="submit" class="btn btn-success">Ubah Data</button>
               <a href="/schedules?kelas={{$classStudent->id}}&semester={{$semester->id}}"
                  class="btn btn-warning">Batal</a>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
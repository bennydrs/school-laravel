@extends('layouts/master')

@section('title', 'Ubah Nilai')
@section('header', 'Ubah Data Nilai')

@section('content')

<div class="row">
   <div class="col-md-12">
      <div class="card card-success">
         <div class="card-header">
            <h3 class="card-title">Ubah Data Nilai</h3>
         </div>

         <form method="post" action="/teacher/grades/{{$grade->id}}" role="form">
            @csrf
            @method('put')
            <div class="card-body">

               <input type="hidden" name="class_room_id" value="{{ $grade->class_room_id }}">
               <input type="hidden" name="semester_id" value="{{ $grade->semester_id }}">
               <input type="hidden" name="student_id" value="{{ $grade->student_id }}">
               <input type="hidden" name="class_learn_id" value="{{ $grade->class_learn_id }}">

               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="nama">Nama</label>
                     <input id="nama" class="form-control" type="text" name="nama" value="{{ $grade->student->nama }}"
                        readonly>
                  </div>

                  <div class="form-group col-md-6">
                     <label for="kelas">Kelas</label>
                     <input id="kelas" class="form-control" type="text" name="class_id"
                        value="{{ $grade->classLearn->classRoom->nama }}" readonly>
                  </div>
               </div>

               <div class="form-group">
                  <label for="mapel">Mata Pelajaran</label>
                  <input id="mapel" class="form-control" type="text" name="mapel"
                     value="{{ $grade->classLearn->subject->nama }}" readonly>
               </div>

               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="nilai_tugas_1">Nilai Tugas 1</label>
                     <input id="nilai_tugas_1" class="form-control" type="text" name="nilai_tugas_1"
                        value="{{ $grade->nilai_tugas_1 }}">
                  </div>

                  <div class="form-group col-md-6">
                     <label for="nilai_tugas_2">Nilai Tugas 2</label>
                     <input id="nilai_tugas_2" class="form-control" type="text" name="nilai_tugas_2"
                        value="{{ $grade->nilai_tugas_2 }}">
                  </div>
               </div>

               <div class="form-row">
                  <div class="form-group col-md-6">
                     <label for="nilai_uts">Nilai UTS</label>
                     <input id="nilai_uts" class="form-control" type="text" name="nilai_uts"
                        value="{{ $grade->nilai_uts }}">
                  </div>

                  <div class="form-group col-md-6">
                     <label for="nilai_uas">Nilai UAS</label>
                     <input id="nilai_uas" class="form-control" type="text" name="nilai_uas"
                        value="{{ $grade->nilai_uas }}">
                  </div>
               </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
               <button type="submit" class="btn btn-success">Ubah Data</button>
               <a href="/teacher/grades?kelas={{$grade->class_room_id}}&semester={{$grade->semester_id}}" class="btn
               btn-warning">Batal</a>
            </div>
         </form>
      </div>
   </div>
</div>

@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
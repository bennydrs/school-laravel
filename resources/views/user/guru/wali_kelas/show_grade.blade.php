@extends('layouts/master')

@section('title', 'Wali Kelas')
@section('header', 'Data Wali Kelas')

@section('content')

<div class="row mb-3">
   <div class="col-md-4">
      Nama :
   </div>
</div>

<div class="row">
   <div class="col-lg">
      {{-- @if(isset($_GET['semester'])) --}}
      {{-- <a href="/wali-kelas/{{ $_GET['semester'] }}/create" class="btn btn-primary">Tambah</a> --}}
      {{-- @if($homeroomTeachers->isNotEmpty()) --}}

      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     Data Nilai
                  </div>
               </div>

               <div class="card-body">

                  <table class="table">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Mata Pelajaran</th>
                           <th>Rata-rata</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($grades as $grade)
                        @php
                        $schedule = \App\Schedule::where('class_room_id', 1)->get();
                        dd($schedule->unique('class_learn_id'))
                        @endphp
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>
                              {{ isset($classLearn->subject->nama) ?  ucfirst($classLearn->subject->nama)  : 'no ada!' }}
                           </td>
                           <td>
                              {{ isset($grade->student->nama) ?  ucfirst($grade->student->nama)  : 'no name!' }}
                           </td>
                           <td>
                              {{ isset($grade->student->jenis_kelamin) ?  ucfirst($grade->student->jenis_kelamin)  : 'no gender!' }}
                           </td>
                           <td>
                              {{ isset($grade->student->alamat) ?  ucfirst($grade->student->alamat)  : 'no address!' }}
                           </td>
                           <td>
                              <a href="/teacher/homeroom-teacher/grades/{{ $grade->id }}"
                                 class="btn btn-info btn-sm">Nilai</a>
                           </td>
                        </tr>
                        @endforeach

                     </tbody>
                  </table>
               </div>
            </div>

         </div>
      </div>

      {{-- @else
<div class="alert alert-danger">
   Data wali kelas tidak ada
</div>
@endif

@else
<div class="alert alert-info">
   Untuk menampilkan wali kelas pilih kelas dan semester
</div>
@endif --}}
   </div>
</div>
@endsection

@section('script')
<script>
   $(document).ready(function(){
      $("table[id^='datatable']").DataTable({
         "pageLength": 50
      });



        // var oTable = $('#datatable').DataTable({
        //     processing: true,
        //     serverSide: true,
        //     ajax: {
        //         url: "/getdataschedules",
        //         type: "get",
        //         data: function (d) {
        //             d.kelas = $('select[name=kelas]').val();
        //             d.semester = $('select[name=semester]').val();
        //         }
        //     },
        //     columns: [
        //         {data: 'hari', name: 'hari'},
        //         {data: 'jam_mulai', name: 'jam_mulai'},
        //         {data: 'jam_selesai', name: 'jam_selesai'},
        //         {data: 'mapel', name: 'mapel'},
        //         {data: 'guru', name: 'guru'},
        //         {data: 'semester', name: 'semester'},
        //         {data: 'aksi', name: 'aksi'}
        //     ]
        // });
        // // jQuery.fn.preventDoubleSubmission = function() {
        // $('#search-form').on('submit', function(e) {
        //     $(".card-title").text('')
        //     $(".tombol").text('')
            
        //     oTable.draw();
        //     e.preventDefault();
        //     let kelasId = $("#kelas").val()
        //     let kelas = $("#kelas option:selected").text()
        //     let semester = $("#semester option:selected").text()
           
        //     window.location.href+'?'+kelasId
        //     $(".card-title").append(' Kelas ' + kelas + ' Semester ' + semester)
        //     $(".tombol").append("<a href='/schedules/" + kelasId +"/create' class='btn btn-primary btn-sm mb-3'>Tambah Jadwal</a>")

        // });
        

        $('#datatable').on('click', '.delete', function(e) {

            e.preventDefault();
            const form = $(this).attr('action');

            Swal.fire({
                title: 'Apa kamu yakin?',
                text: "Data jadwal ini akan hilang!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.value) {
                    $('.delete').submit();
                }
            })
        });
    });
</script>
@endsection

{{-- <form action="" method="post" id="search-form">
            <div class="row">
                <div class="col-auto">
                    <div class="form-group">
                        <select name="kelas" id="kelas" class="form-control custom-select">
                            <option value="">Pilih kelas</option>
                            @foreach ($classes as $class)
                            <option value="{{$class->id}}"
{{ old('kelas') == $class->id ? 'selected' : '' }}>{{ $class->nama }}</option>
@endforeach
</select>
</div>
</div>
<div class="col-auto">
   <div class="form-group">
      <select name="semester" id="semester" class="form-control custom-select">
         <option value="">Pilih semester</option>
         @foreach ($semesters as $semester)
         <option value="{{$semester->id}}">{{ $semester->tahun_ajaran .' | '. $semester->semester }}
         </option>
         @endforeach
      </select>
   </div>
</div>
<div class="col-auto">
   <button type="submit" class="btn btn-success">Tampilkan</button>
</div>
</div>

</form> --}}
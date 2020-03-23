@extends('layouts/master')

@section('title', 'Wali Kelas')
@section('header', 'Data Wali Kelas')

@section('content')

<a href="/teacher/homeroom-teacher/class/{{ $student->class_room_id }}/semester/{{ $student->semester_id }}"
   class="btn btn-danger btn-sm mb-3">Kembali</a>

<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div class="row">
               <div class="col-md-6">
                  Nama : {{$student->student->nama}}
               </div>
               <div class="col-md-6">
                  Kelas : {{$student->classRoom->nama}}
               </div>
            </div>
         </div>
      </div>
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

                  <table class="table table-bordered table-sm">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Mata Pelajaran</th>
                           <th>Nilai Tugas 1</th>
                           <th>Nilai Tugas 2</th>
                           <th>Nilai UTS</th>
                           <th>Nilai UAS</th>
                           <th>Rata-rata</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>
                        @php
                        $sum = 0;
                        @endphp
                        @foreach ($nilai->unique('subject_id') as $grade)
                        @php
                        $jmltugas = $grade->nilai_tugas_1 + $grade->nilai_tugas_2;
                        $rata2tugas = $jmltugas / 2;

                        $tugas = $rata2tugas * 0.25;
                        $uts = $grade->nilai_uts * 0.35;
                        $uas = $grade->nilai_uas * 0.40;
                        $rata2 = $tugas + $uts + $uas;

                        $sum += $rata2
                        @endphp
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>
                              {{ isset($grade->nama) ? ucfirst($grade->nama) :
                              'no name!' }}
                           </td>
                           <td>
                              {{ isset( $grade->nilai_tugas_1) ?  ucfirst($grade->nilai_tugas_1)  : '-' }}
                           </td>
                           <td>
                              {{ isset($grade->nilai_tugas_2) ?  ucfirst($grade->nilai_tugas_2)  : '-' }}
                           </td>
                           <td>
                              {{ isset($grade->nilai_uts) ?  ucfirst($grade->nilai_uts)  : '-' }}
                           </td>
                           <td>
                              {{ isset($grade->nilai_uas) ?  ucfirst($grade->nilai_uas)  : '-' }}
                           </td>
                           <td>
                              {{ (round($rata2,2)) ? (round($rata2,2))  : '-' }}
                           </td>
                           <td>

                              {{-- <a href="/teacher/homeroom-teacher/grades/{{ $grade->id }}"
                              class="btn btn-info btn-sm">Nilai</a> --}}
                           </td>
                        </tr>

                        @endforeach
                        @php
                        // dd($semester_id);
                        $ss = \App\Grade::where('class_student_id',$student->id)->where('semester_id',
                        $semester_id)->get();
                        $jm = count($ss);
                        // dd($jm);
                        @endphp
                        @php
                        $jumlahData = count($nilai->unique('subject_id'));
                        @endphp
                        <tr>
                           <td colspan="6" class="text-center text-bold">Rata-rata</td>
                           <td>
                              {{ round($sum / $jm, 2) }}
                              {{-- {{ $sum / $jumlahData }} --}}
                           </td>
                        </tr>
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
@extends('layouts/master')

@section('title', 'Nilai')
@section('header', 'Data Nilai')

@section('content')

<div class="row">
   <div class="col-lg">
      <form action="/student/grades" method="get">
         <div class="row">
            <div class="col-auto">
               <div class="form-group">
                  <select name="kelas" id="kelas" class="form-control" required>
                     <option value="">Pilih kelas</option>
                     @foreach ($classes as $class)
                     <option value="{{$class->id}}" {{ ($_GET) ? $_GET['kelas'] == $class->id ? 'selected' : '' : '' }}>
                        {{ $class->classRoom->nama }}</option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-auto">
               <div class="form-group">
                  <select name="semester" id="semester" class="form-control" required>
                     <option value="">Pilih semester</option>
                     @foreach ($semesters as $semester)
                     <option value="{{$semester->id}}"
                        {{ ($_GET) ? $_GET['semester'] == $semester->id ? 'selected' : '' : '' }}>
                        {{ $semester->tahun_ajaran .' | '. $semester->semester }}
                     </option>
                     @endforeach
                  </select>
               </div>
            </div>
            <div class="col-auto">
               <button type="submit" class="btn btn-success">Tampilkan</button>
            </div>
         </div>
      </form>

      @if(isset($_GET['kelas']))

      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Nilai Kelas
               {{-- {{$grades[0]->classLearn->semester->tahun_ajaran .' | '. $grades[0]->classLearn->semester->semester   }}
               --}}

            </div>
         </div>

         <div class="card-body">

            <a href="" class="btn btn-primary btn-sm mb-3">Export PDF</a>

            @if($grades->isNotEmpty())
            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Nama</th>
                     <th>Mata Pelajaran</th>
                     <th>Nilai Tugas 1</th>
                     <th>Nilai Tugas 1</th>
                     <th>Nilai UTS</th>
                     <th>Nilai UAS</th>
                     <th>Guru</th>
                     <th>Semester</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($grades as $grade)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $grade->classStudent->student->nama }}</td>
                     <td>{{ $grade->classLearn->subject->nama }}</td>
                     <td>{{ $grade->nilai_tugas_1 }}</td>
                     <td>{{ $grade->nilai_tugas_2 }}</td>
                     <td>{{ $grade->nilai_uts }}</td>
                     <td>{{ $grade->nilai_uas }}</td>
                     <td>{{ $grade->teacher->nama }}</td>
                     <td>{{ $grade->semester->semester }}</td>
                  </tr>
                  @endforeach

               </tbody>
            </table>

            @else
            <div class="alert alert-danger">
               Data nilai tidak ada
            </div>
            @endif

            @else
            <div class="alert alert-info">
               Untuk menampilkan nilai pilih kelas dan semester
            </div>
            @endif
         </div>
      </div>
   </div>
</div>
@endsection

@section('script')
<script>
   $(document).ready(function(){
      $('#datatable').DataTable({
            // kelas = $('select[name=kelas]').val();
            // semester = $('select[name=semester]').val();
            //     processing: true,
            //     serverside: true,
            //     ajax: "/getdataschedule",
            //     columns:[
            //         { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            //         {data: 'hari', name: 'hari'},
            //         {data: 'jam_mulai', name: 'jam_mulai'},
            //         {data: 'jam_selesai', name: 'jam_selesai'},
            //         {data: 'mapel', name: 'mapel'},
            //         {data: 'guru', name: 'guru'},
            //         {data: 'semester', name: 'semester'},
            //         {data: 'aksi', name: 'aksi'},
            //     ]
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
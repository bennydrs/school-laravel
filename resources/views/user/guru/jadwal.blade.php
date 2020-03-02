@extends('layouts/master')

@section('title', 'Jadwal Guru')
@section('header', 'Data Jadwal Guru')

@section('content')

<div class="row">
   <div class="col-lg">

      <form action="/teacher/schedules" method="get">
         <div class="row">
            <div class="col-md-3">
               <div class="input-group mb-3">
                  <select name="semester" id="semester" class="form-control" required>
                     <option value="">Pilih semester</option>
                     @foreach ($semesters as $semester)
                     <option value="{{$semester->id}}"
                        {{ ($_GET) ? $_GET['semester'] == $semester->id ? 'selected' : '' : '' }}>
                        {{ $semester->tahun_ajaran .' | '. $semester->semester }}
                     </option>
                     @endforeach
                  </select>
                  <div class="input-group-append">
                     <button type="submit" class="btn btn-success">Tampilkan</button>
                  </div>
               </div>
            </div>
         </div>
      </form>

      @if(isset($_GET['semester']))
      @if($schedules->isNotEmpty())

      <div class="card">
         <div class="card-header">
            <div class="card-title">
               Data Jadwal Semester
               {{ $schedules[0]->semester->tahun_ajaran .' | '. $schedules[0]->semester->semester }}
            </div>
         </div>

         <div class="card-body">

            <a href="#" class="btn btn-info btn-sm mb-3">Export PDF</a>

            <table class="table" id="datatable">
               <thead>
                  <tr>
                     <th>No</th>
                     <th>Hari</th>
                     <th>Jam</th>
                     <th>Kelas</th>
                     <th>Mata Pelajaran</th>
                     <th>Semester</th>
                  </tr>
               </thead>
               <tbody>

                  @foreach ($schedules as $s)
                  <tr>
                     <td>{{ $loop->iteration }}</td>
                     <td>{{ $s->hari }}</td>
                     <td>{{ $s->jam_mulai .' - '.  $s->jam_selesai}}</td>
                     <td>{{ $s->classLearn->classRoom->nama }}</td>
                     <td>{{ $s->classLearn->subject->nama }}</td>
                     <td>{{ $s->semester->semester }}</td>
                  </tr>
                  @endforeach

               </tbody>
            </table>

            @else
            <div class="alert alert-danger">
               Data jadwal tidak ada
            </div>
            @endif

            @else
            <div class="alert alert-info">
               Untuk menampilkan jadwal, pilih semester
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
      $('#datatable').DataTable();

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
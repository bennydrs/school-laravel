@extends('layouts/master')

@section('title', 'Wali Kelas')
@section('header', 'Data Wali Kelas')

@section('content')

<div class="row">
   <div class="col-lg">
      <form action="/wali-kelas" method="get">
         <div class="row">
            <div class="col-md-3">
               <div class="input-group mb-3">
                  <select name="semester" id="semester" class="form-control" required>
                     <option value="">Pilih tahun ajaran</option>
                     @foreach ($semesters->unique('tahun_ajaran') as $semester)
                     <option value="{{$semester->id}}"
                        {{ ($_GET) ? $_GET['semester'] == $semester->id ? 'selected' : '' : '' }}>
                        {{ $semester->tahun_ajaran  }}
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
      <a href="/wali-kelas/{{ $_GET['semester'] }}/create" class="btn btn-primary mb-3">Tambah</a>
      @if($homeroomTeachers->isNotEmpty())

      <div class="row">
         <div class="col-md-6">
            <div class="card">
               <div class="card-header">
                  <div class="card-title">
                     Data Wali Kelas
                  </div>
               </div>

               <div class="card-body">

                  <table class="table" id="datatable">
                     <thead>
                        <tr>
                           <th>No</th>
                           <th>Nama</th>
                           <th>Kelas</th>
                           <th>Aksi</th>
                        </tr>
                     </thead>
                     <tbody>

                        @foreach ($homeroomTeachers as $ht)
                        <tr>
                           <td>{{ $loop->iteration }}</td>
                           <td>{{ isset($ht->teacher->nama) ?  ucfirst($ht->teacher->nama)  : 'no name!' }}
                           </td>
                           <td>
                              {{ isset($ht->classRoom->nama) ?  ucfirst($ht->classRoom->nama)  : 'no name!' }}
                           </td>
                           <td>
                              {{-- <a href="/wali-kelas/{{ $ht->id }}/edit" class="btn btn-warning btn-sm">edit</a> --}}
                              <form action="/wali-kelas/{{ $ht->id }}" method="post" class="d-inline delete">
                                 @csrf
                                 @method('delete')
                                 <button type="submit" class="btn btn-danger btn-sm">hapus</button>
                              </form>
                           </td>
                        </tr>
                        @endforeach

                     </tbody>
                  </table>
               </div>
            </div>

         </div>
      </div>

      @else
      <div class="alert alert-danger">
         Data wali kelas tidak ada
      </div>
      @endif

      @else
      <div class="alert alert-info">
         Untuk menampilkan wali kelas pilih kelas dan semester
      </div>
      @endif
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
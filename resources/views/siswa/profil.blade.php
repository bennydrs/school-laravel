@extends('layouts/master')

@section('title', 'Profil')
@section('header', 'Profil')

@section('content')

<div class="row">
   <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
         <div class="card-body box-profile">
            <div class="text-center">
               <img class="profile-user-img img-fluid img-circle" src="{{ $student->getFoto() }}"
                  alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ $student->nama }}</h3>

            <p class="text-muted text-center">{{ $student->nis }} </p>

            {{-- <ul class="list-group list-group-unbordered mb-3"> --}}
            {{-- <li class="list-group-item">
                  <b>Mata Pelajaran</b> <a class="float-right">{{ !empty($grades) ? $grades->count():'0' }}</a>
            </li> --}}
            <hr>

            <b><i class="fas fa-calendar-day mr-1"></i> Tempat Tanggal Lahir</b>

            <p class="text-muted">
               {{ $student->tempat_lahir .', '. $student->tanggal_lahir->format('d M Y') }}
            </p>

            <hr>
            <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>

            <p class="text-muted">
               {{$student->jenis_kelamin}}
            </p>

            <hr>
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

            <p class="text-muted">{{ $student->alamat }}</p>
            <hr>

            <strong><i class="fas fa-praying-hands mr-1"></i> Agama</strong>

            <p class="text-muted">
               {{ $student->agama }}
            </p>
            <hr>

            <strong><i class="far fa-envelope mr-1"></i> Email</strong>

            <p class="text-muted">{{ $student->user->email }}</p>

            <hr>

            <a href="/students/{{$student->id}}/edit" class="btn btn-success btn-sm">Edit</a>


            {{-- </ul> --}}
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->

   </div>

   <!-- /.col -->
   <div class="col-md-9">
      <div class="card card-primary card-outline">
         <div class="card-header p-2">
            <ul class="nav nav-pills">
               <li class="nav-item">
                  @if($grades->isNotEmpty())
                  @foreach ($grades->unique('semester_id') as $row => $grade)
                  @php
                  $_GET['s'] = ($_GET) ? $_GET['s'] : '';
                  $thn_ajar1 = substr($grade->semester->tahun_ajaran, 2, 2);
                  $thn_ajar2 = substr($grade->semester->tahun_ajaran, 7, 2);
                  $tahun_ajaran = $thn_ajar1 .'/'. $thn_ajar2;
                  @endphp
                  {{-- <a class="nav-link active" href="#" data-toggle="tab">gg</a> --}}
                  <form action="" method="get">
                     <a href="javascript:;" onclick="parentNode.submit();"
                        class="nav-link @if($_GET['s']==$grade->semester_id) active @endif"
                        href="{{$grade->semester_id}}"
                        data-toggle="tab">{{$tahun_ajaran .' | '. $grade->semester->semester}}</a>
                     <input type="hidden" name="s" value={{ $grade->semester_id }} />
                  </form>

                  {{-- <a class="nav-link @if($row == 0) active @endif" href="{{$grade->semester_id}}"
                  aria-controls="#{{ $grade->semester_id }}"
                  data-toggle="tab">{{$grade->semester->tahun_ajaran .' | '. $grade->semester->semester}}</a> --}}
               </li>
               @endforeach
               @endif
            </ul>
         </div><!-- /.card-header -->
         <div class="card-body">
            <div class="tab-content">
               @if($grades->isNotEmpty())
               @foreach ($grades as $row => $grade)
               <div @if($grade->semester_id) class="active tab-pane" @else class="tab-pane" @endif
                  id="{{ $grade->semester_id }}">
                  @endforeach
                  <div class="table-responsive">

                     <table class="table table-hover">
                        <thead>
                           <tr>
                              <th>No</th>
                              <th>Mata Pelajaran</th>
                              {{-- <th>Guru</th> --}}
                              <th>Kelas</th>
                              <th>Semester</th>
                              <th>Nilai Tugas</th>
                              <th>Nilai UTS</th>
                              <th>Nilai UAS</th>
                              <th>Rata2</th>
                           </tr>
                        </thead>
                        <tbody id="subject">
                           @php
                           $z = \App\Grade::where('semester_id', $_GET['s'])->where('class_student_id',
                           $grade->class_student_id)->get();
                           // dd($_GET['s']);
                           @endphp
                           @if(isset($_GET['s']))

                           @foreach ($z as $item)
                           @php
                           $jmltugas = $item->nilai_tugas_1 + $item->nilai_tugas_1;
                           $rata2tugas = $jmltugas / 2;

                           $tugas = $rata2tugas * 25/100;
                           $uts = $item->nilai_uts * 35/100;
                           $uas = $item->nilai_uas * 40/100;
                           $rata2 = $tugas + $uts + $uas;
                           @endphp
                           <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $item->classLearn->subject->nama }}</td>
                              {{-- <td>{{ $item->schedule->teacher->nama }}</td> --}}
                              <td>{{ $item->classLearn->classRoom->nama }}</td>
                              <td>{{ $item->semester->tahun_ajaran .' | '. $item->semester->semester}}</td>
                              <td>{{ $rata2tugas }}</td>
                              <td>{{ $item->nilai_uts }}</td>
                              <td>{{ $item->nilai_uas }}</td>
                              <td>{{ $rata2 }}</td>
                           </tr>
                           @endforeach
                           @else
                           <td>ff</td>
                           @endif
                        </tbody>
                     </table>
                  </div>

               </div>
               @else
               Belum ada nilai
               @endif
               {{-- @endforeach --}}

            </div>
            <!-- /.tab-content -->
         </div>

      </div>
      <!-- /.card-body -->
   </div>
   <!-- /.nav-tabs-custom -->

</div>
<!-- /.col -->
</div>

@endsection
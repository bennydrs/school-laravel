@extends('layouts/master')

@section('title', 'Profil Guru')
@section('header', 'Profil Guru')

@section('content')

<div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ $teacher->getFoto() }}" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $teacher->nama }}</h3>

          <p class="text-muted text-center">{{ $teacher->nrg }} </p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Mata Pelajaran</b> <a class="float-right">{{ !empty($classLearn) ? $classLearn->count() : '0' }}</a>
            </li>
            
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- About Me Box -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Data Diri</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <strong><i class="fas fa-calendar-day mr-1"></i> Tempat Tanggal Lahir</strong>

          <p class="text-muted">
            {{ $teacher->tempat_lahir .', '. $teacher->tanggal_lahir->format('d M Y') }}
          </p>

          <hr>

          <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>

          <p class="text-muted">
            {{$teacher->jenis_kelamin}}
          </p>

          <hr>

          <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

          <p class="text-muted">{{ $teacher->alamat }}</p>

          <hr>

          <strong><i class="fas fa-praying-hands mr-1"></i> Agama</strong>

          <p class="text-muted">
            {{ $teacher->agama }}
          </p>

          <hr>

          <strong><i class="far fa-envelope mr-1"></i> Email</strong>

          <p class="text-muted">{{ $teacher->user->email }}</p>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="card">
        <div class="card-header p-2">
          <ul class="nav nav-pills">
            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
          </ul>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content">
            <div class="active tab-pane" id="activity">
              
              <table class="table table-hover">
                  <thead>
                      <tr>
                          <th>No</th>
                          <th>Mata Pelajaran</th>
                          <th>Kelas</th>
                          <th>Hari</th>
                          <th>Jam Mulai</th>
                          <th>Jam Selesai</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($schedules as $item)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->classLearn->subject->nama}}</td>
                      <td>{{$item->classLearn->classRoom->nama}}</td>
                      <td>{{$item->hari}}</td>
                      <td>{{$item->jam_mulai}}</td>
                      <td>{{$item->jam_selesai}}</td>
                    </tr>
                    @endforeach
                  </tbody>
              </table>

            </div>

            <div class="tab-pane" id="settings">
              <form class="form-horizontal">
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName2" placeholder="Name">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                  <div class="col-sm-10">
                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="submit" class="btn btn-danger">Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>

  @endsection
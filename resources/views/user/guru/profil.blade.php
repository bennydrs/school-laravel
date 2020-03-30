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
               <img class="profile-user-img img-fluid img-circle" src="{{ $teacher->getFoto() }}"
                  alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{ $teacher->nama }}</h3>

            <p class="text-muted text-center">{{ $teacher->nrg }} </p>

            {{-- <ul class="list-group list-group-unbordered mb-3">
               <li class="list-group-item">
                  <b>Mata Pelajaran</b> <a
                     class="float-right">{{ !empty($classLearn) ? $classLearn->count() : '0' }}</a>
            </li>

            </ul> --}}
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <!-- /.card -->
   </div>
   <!-- /.col -->
   <div class="col-md-9">

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

            <hr>

            <strong><i class="fas fa-phone mr-1"></i> No. Telepon</strong>

            <p class="text-muted">{{ $teacher->telp }}</p>

            <hr>

            <a href="/teacher/edit-profile" class="btn btn-success btn-sm">Edit Profil</a>
            <a href="/teacher/changePassword" class="btn btn-warning btn-sm">Ganti Kata Sandi</a>
         </div>
         <!-- /.card-body -->
      </div>

      <!-- /.nav-tabs-custom -->
   </div>
   <!-- /.col -->
</div>

@endsection
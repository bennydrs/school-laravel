@extends('layouts/master')

@section('title', 'Profil Admin')
@section('header', 'Profil Admin')

@section('content')

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="card card-primary card-outline">
      <div class="card-body box-profile">
        <div class="text-center">
          <img class="profile-user-img img-fluid img-circle" src="{{ $admin->getFoto() }}" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{ $admin->nama }}</h3>

        <p class="text-muted text-center">{{ $admin->nip }} </p>

        <ul class="list-group list-group-unbordered mb-3">
          <li class="list-group-item">
            <b>Role</b> <a class="float-right">{{ auth()->user()->role }}</a>
          </li>
          <li class="list-group-item">
            <b>No Telepon</b> <a class="float-right">{{ $admin->telp }}</a>
          </li>

        </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

  <div class="col-md-9">


    <!-- About Me Box -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Data Diri</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <strong><i class="fas fa-calendar-day mr-1"></i> Tempat Tanggal Lahir</strong>

        <p class="text-muted">
          {{ $admin->tempat_lahir .', '. $admin->tanggal_lahir->format('d M Y') }}
        </p>

        <hr>

        <strong><i class="fas fa-venus-mars mr-1"></i> Jenis Kelamin</strong>

        <p class="text-muted">
          {{$admin->jenis_kelamin}}
        </p>

        <hr>

        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>

        <p class="text-muted">{{ $admin->alamat }}</p>

        <hr>

        <strong><i class="fas fa-praying-hands mr-1"></i> Agama</strong>

        <p class="text-muted">
          {{ $admin->agama }}
        </p>

        <hr>

        <strong><i class="far fa-envelope mr-1"></i> Email</strong>

        <p class="text-muted">{{ $admin->user->email }}</p>

        <hr>

        @if (auth()->user()->admin->id == $admin->id)
        <a href="admins/{{auth()->user()->admin->id}}/edit" class="btn btn-success btn-sm">Edit Profil</a>
        <a href="changePassword" class="btn btn-warning btn-sm">Ganti Kata Sandi</a>
        @endif

      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->

</div>

@endsection
@extends('layouts/master')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ totalSiswa() }}</h3>

                <p>Siswa</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ totalGuru() }}</h3>

                <p>Guru</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{totalAdmin()}}</h3>

                <p>Admin</p>
            </div>
            <div class="icon">
                <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ totalKelas() }}</h3>

                <p>Kelas</p>
            </div>
            <div class="icon">
                <i class="fas fa-school"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

@endsection
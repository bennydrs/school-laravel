@extends('layouts/master')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pengumuman</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
            {{-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
            </button> --}}
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
        <ul class="products-list product-list-in-card">
            @foreach ($informations as $info)
            <li class="item">
                <div class="ml-4">
                    <a href="/student/dashboard/information/{{$info->id}}" class="product-title">{{$info->judul}}</a>
                    <span class="product-description">
                        {!! str_limit($info->konten, 50) !!}
                    </span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- /.card-body -->
    <div class="card-footer text-center">
        <a href="javascript:void(0)" class="uppercase">View All</a>
    </div>
    <!-- /.card-footer -->
</div>
@endsection
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
        <a href="javascript:void(0)" class="uppercase">View All </a>
    </div>
    <!-- /.card-footer -->
</div>
@php

// dd($uas)
@endphp
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Chart</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div id="chartSiswa" style="width:100%; height:400px;"></div>
    </div>
    <!-- /.card-body -->
</div>
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
    // Highcharts.chart('chartSiswa', {
    //     chart: {
    //         type: 'column'
    //     },
    //     title: {
    //         text: 'Nilai Rata-rata'
    //     },
    //     subtitle: {
    //         text: 'Source: WorldClimate.com'
    //     },
    //     xAxis: {
    //         categories: {!! json_encode($semester) !!},
    //         crosshair: true
    //     },
    //     yAxis: {
    //         min: 0,
    //         title: {
    //             text: 'Nilai'
    //         }
    //     },
    //     tooltip: {
    //         headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    //         pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
    //             '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
    //         footerFormat: '</table>',
    //         shared: true,
    //         useHTML: true
    //     },
    //     plotOptions: {
    //         column: {
    //             pointPadding: 0.2,
    //             borderWidth: 0
    //         }
    //     },
    //     series: [{
    //         name: 'Nilai',
    //         data: {!! json_encode($rata2) !!}

    //     }]
    // });

    Highcharts.chart('chartSiswa', {

        title: {
            text: 'Nilai Rata-rata per Semester'
        },

        yAxis: {
            max: 100,
            title: {
                text: 'Nilai'
            }
        },

        xAxis: {
            categories: {!! json_encode($semester) !!}
        },

        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                }
            }
        },

        series: [{
            name: 'Nilai',
            data: {!! json_encode($rata2) !!}
        }],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
</script>
@endsection
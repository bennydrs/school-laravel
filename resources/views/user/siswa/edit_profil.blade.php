@extends('layouts/master')

@section('title', 'Ubah Siswa')
@section('header', 'Ubah Data Siswa')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">Ubah Data Siswa</h3>
         </div>
         <!-- /.card-header -->
         <!-- form start -->
         <form method="post" action="/student/edit/{{$student->id}}" role="form" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
               <div class="form-group">
                  <label for="nis">NIS</label>
                  <input type="text" name="nis" class="form-control" id="nis" value="{{ $student->nis }}" readonly>
               </div>

               <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama"
                     value="{{ $student->nama }}" readonly>
                  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror

               </div>

               {{-- <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="">
                </div> --}}

               <div class="form-group">
                  <label for="tempat_lahir">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir"
                     class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir"
                     value="{{ $student->tempat_lahir }}">
                  @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="tanggal_lahir">Tanggal Lahir:</label>
                  <div class="input-group">
                     <div class="input-group-prepend">
                        <span class="input-group-text">
                           <i class="far fa-calendar-alt"></i>
                        </span>
                     </div>
                     <input type="text" name="tanggal_lahir"
                        class="form-control float-right  @error('tanggal_lahir') is-invalid @enderror"
                        id="tanggal_lahir" value="{{ $student->tanggal_lahir->format('Y-m-d') }}">
                     @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>
               </div>

               <div class="form-group">
                  <label for="janis_kalamin">Jenis Kelamin</label>
                  <select class="form-control custom-select  @error('jenis_kelamin') is-invalid @enderror"
                     id="jenis_kelamin" name="jenis_kelamin">
                     <option value="" selected="" disabled="">Pilih jenis kelamin</option>
                     <option value="Laki-laki" {{ $student->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                     </option>
                     <option value="Perempuan" {{ $student->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                     </option>
                  </select>
                  @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="agama">Agama</label>
                  <select class="form-control custom-select  @error('agama') is-invalid @enderror" id="agama"
                     name="agama">
                     <option value="" selected="" disabled="">Pilih agama</option>
                     <option value="Islam" {{ $student->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                     <option value="Kristen" {{ $student->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                     <option value="Katolik" {{ $student->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                     <option value="Budha" {{ $student->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                     <option value="Hindu" {{ $student->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                  </select>
                  @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
               </div>

               <div class="form-group">
                  <label for="alamat">Alamat</label>
                  <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror" id="alamat"
                     placeholder="Masukkan alamat">{{ $student->alamat }}</textarea>
                  @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror

               </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
               <button type="submit" class="btn btn-primary">Ubah Data</button>
               <a href="{{ url()->previous() }}" class="btn btn-warning">Batal</a>
            </div>
         </form>
      </div>
   </div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
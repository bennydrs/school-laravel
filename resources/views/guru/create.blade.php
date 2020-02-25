@extends('layouts/master')

@section('title', 'Tambah Guru')
@section('header', 'Tambah Data Guru')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Input Data Guru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            @php
              $nrg = substr($nrgTerakhir, 1) + 1
            @endphp 
            <form method="post" action="/teachers" role="form" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="nrg">NRG</label>
                  <input type="text" name="nrg" class="form-control @error('nrg') is-invalid @enderror" id="nrg" placeholder="Masukkan nrg" value="{{ 'G'.$nrg }}">
                  @error('nrg') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" placeholder="Masukkan nama" value="{{ old('nama') }}">
                  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Masukkan email" value="{{ old('email') }}">
                  @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="tempat_lahir">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" placeholder="Masukkan tempat lahir" value="{{ old('tempat_lahir') }}">
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
                      <input type="text" name="tanggal_lahir" class="form-control float-right @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                      @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="janis_kalamin">Jenis Kelamin</label>
                    <select class="form-control custom-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                      <option value="" selected="" disabled="">Pilih jenis kelamin</option>
                      <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control custom-select @error('agama') is-invalid @enderror" id="agama" name="agama">
                      <option value="" selected="" disabled="">Pilih agama</option>
                      <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                      <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                      <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                      <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                      <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    </select>
                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="telp">No. Telepon</label>
                  <input type="telp" name="telp" data-inputmask="'mask': ['999-9999-9999']" data-mask="" im-insert="true" class="form-control @error('telp') is-invalid @enderror" id="telp" placeholder="Masukkan telp" value="{{ old('telp') }}">
                  @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat">{{ old('nama') }}</textarea>
                    @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                  <label for="exampleInputFile">Foto</label>
                  <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="foto" id="customFile">
                      <label class="custom-file-label" for="exampleInputFile">Pilih file</label>
                    </div>
                  </div>
                </div>
           
              </div>
              <!-- /.card-body -->
        
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Tambah Data</button>
                <a href="/teachers" class="btn btn-warning">Batal</a>
              </div>
            </form>
          </div>
    </div>
</div>  


@endsection

@section('script')
    <script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
    <script src="{{ asset('assets/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
      $('[data-mask]').inputmask()
    </script>
@endsection
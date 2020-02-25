@extends('layouts/master')

@section('title', 'Ubah Guru')
@section('header', 'Ubah Data Guru')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Ubah Data Guru</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form method="post" action="/teachers/{{$teacher->id}}" role="form" enctype="multipart/form-data">
                @csrf
                @method('put')
              <div class="card-body">
                <div class="form-group">
                    <label for="nrg">NRG</label>
                    <input type="text" name="nrg" class="form-control" id="nrg" value="{{ $teacher->nrg }}" readonly>
                </div>

                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" value="{{ $teacher->nama }}">
                  @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control" id="email" value="">
                </div> --}}

                <div class="form-group">
                  <label for="tempat_lahir">Tempat Lahir</label>
                  <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" id="tempat_lahir" value="{{ $teacher->tempat_lahir }}">
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
                      <input type="text" name="tanggal_lahir" class="form-control float-right  @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" value="{{ $teacher->tanggal_lahir->format('Y-m-d') }}">
                      @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="janis_kalamin">Jenis Kelamin</label>
                    <select class="form-control custom-select  @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin">
                      <option value="" selected="" disabled="">Pilih jenis kelamin</option>
                      <option value="Laki-laki" {{ $teacher->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                      <option value="Perempuan" {{ $teacher->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control custom-select  @error('agama') is-invalid @enderror" id="agama" name="agama">
                      <option value="" selected="" disabled="">Pilih agama</option>
                      <option value="Islam" {{ $teacher->agama == 'Islam' ? 'selected' : '' }}>Islam</option>
                      <option value="Kristen" {{ $teacher->agama == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                      <option value="Katolik" {{ $teacher->agama == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                      <option value="Budha" {{ $teacher->agama == 'Budha' ? 'selected' : '' }}>Budha</option>
                      <option value="Hindu" {{ $teacher->agama == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    </select>
                    @error('agama') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                  <label for="telp">No. Telepon</label>
                  <input type="telp" name="telp" data-inputmask="'mask': ['999-9999-9999']" data-mask="" im-insert="true" class="form-control @error('telp') is-invalid @enderror" id="telp" value="{{ $teacher->telp }}">
                  @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" class="form-control  @error('alamat') is-invalid @enderror" id="alamat" placeholder="Masukkan alamat">{{ $teacher->alamat }}</textarea>
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
                <button type="submit" class="btn btn-primary">Ubah Data</button>
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
 
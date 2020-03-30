@extends('layouts/master')

@section('title', 'Ganti Kata Sandi')
@section('header', 'Ganti Kata Sandi')

@section('content')

<div class="row">
   <div class="col-md-6">
      <div class="card card-primary">
         <div class="card-header">
            <h3 class="card-title">Ganti Kata Sandi</h3>
         </div>

         <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">
            @csrf
            <div class="card-body">
               {{-- @if (session('error'))
               <div class="alert alert-danger">
                  {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
               {{ session('success') }}
            </div>
            @endif --}}

            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
               <label for="new-password" class="control-label">Current Password</label>

               <input id="current-password" type="password" class="form-control" name="current-password" required>

               @if ($errors->has('current-password'))
               <span class="help-block">
                  <strong>{{ $errors->first('current-password') }}</strong>
               </span>
               @endif

            </div>

            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
               <label for="new-password" class="control-label">New Password</label>


               <input id="new-password" type="password" class="form-control" name="new-password" required>

               @if ($errors->has('new-password'))
               <span class="help-block">
                  <strong>{{ $errors->first('new-password') }}</strong>
               </span>
               @endif

            </div>

            <div class="form-group">
               <label for="new-password-confirm" class=" control-label">Confirm New Password</label>


               <input id="new-password-confirm" type="password" class="form-control" name="new-password-confirm"
                  required>

            </div>

      </div>
      <!-- /.card-body -->

      <div class="card-footer">
         <button type="submit" class="btn btn-primary">Simpan</button>
         <a href="  @if(auth()->user()->role == 'siswa')
            /student/profile
            @elseif(auth()->user()->role == 'admin')
            /admin
            @else
            /teahers/profile
            @endif" class="btn btn-warning">Batal</a>
      </div>
      </form>
   </div>
</div>
</div>


@endsection

@section('script')
<script src="{{ asset('assets/js/script-input-edit.js') }}"></script>
@endsection
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <title>@yield('title')</title>
   <!-- Tell the browser to be responsive to screen width -->
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
   <!-- Ionicons -->
   <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- overlayScrollbars -->
   <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/datepicker/css/bootstrap-material-datetimepicker.css') }}">
   <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}">
   <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css" />

   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <!-- Site wrapper -->
   <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
         <!-- Left navbar links -->
         <ul class="navbar-nav">
            <li class="nav-item">
               <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="../../index3.html" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
               <a href="#" class="nav-link">Contact</a>
            </li>
         </ul>

         <!-- SEARCH FORM -->
         {{-- <form class="form-inline ml-3">
            <div class="input-group input-group-sm">
               <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
               <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                     <i class="fas fa-search"></i>
                  </button>
               </div>
            </div>
         </form> --}}

         <!-- Right navbar links -->
         <ul class="navbar-nav ml-auto">

            <li class="nav-item dropdown">
               <a class="nav-link" data-toggle="dropdown" href="#">
                  {{-- <i class="far fa-bell"></i> --}}
                  {{auth()->user()->name}}
                  {{-- <span class="badge badge-warning navbar-badge">15</span> --}}
               </a>
               <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <a href="#" class="dropdown-item">
                     <i class="fas fa-sign-out-alt mr-2"></i> Logout
                  </a>
                  <div class="dropdown-divider"></div>

               </div>
            </li>
         </ul>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <!-- Brand Logo -->
         <a href="../../index3.html" class="brand-link">
            {{-- <img src="/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8"> --}}
            <span class="brand-text font-weight-light">SEKOLAH</span>
         </a>

         <!-- Sidebar -->
         <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                  <img src="
                     @if(auth()->user()->role == 'siswa')
                        {{ auth()->user()->student->getFoto() }}
                     @elseif(auth()->user()->role == 'admin')
                        {{ auth()->user()->admin->getFoto() }}
                     @else
                        {{ auth()->user()->teacher->getFoto() }}
                     @endif
                     " class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                  <a href="
                        @if(auth()->user()->role == 'siswa')
                        /students/{{ auth()->user()->student->id }}
                        @elseif(auth()->user()->role == 'admin')
                        /admins/{{ auth()->user()->admin->id }}
                        @else
                        /teahers/{{ auth()->user()->teacher->id }}
                        @endif" class="d-block">{{ auth()->user()->name }}</a>
               </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                  @if(auth()->user()->role == 'admin')
                  <li class="nav-item">
                     <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/students" class="nav-link {{ Request::is('students*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Siswa</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/class-rooms" class="nav-link {{ Request::is('class-rooms*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-school"></i>
                        <p>Kelas</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/subjects" class="nav-link {{ Request::is('subjects*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Mata Pelajaran</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/teachers" class="nav-link {{ Request::is('teachers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Guru</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/semesters" class="nav-link {{ Request::is('semesters*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Semester</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/wali-kelas" class="nav-link {{ Request::is('wali-kelas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-alt"></i>
                        <p>Wali Kelas</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/class-learns" class="nav-link {{ Request::is('class-learns*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chalkboard-teacher"></i>
                        <p>Kelas Ajar</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/class-students" class="nav-link {{ Request::is('class-students*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-chair"></i>
                        <p>Kelas Siswa</p>
                     </a>
                  </li>

                  {{-- <li class="nav-item">
                     <a href="/absents" class="nav-link {{ Request::is('absents*') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-table"></i>
                  <p>Absensi Siswa</p>
                  </a>
                  </li> --}}

                  <li class="nav-item">
                     <a href="/schedules" class="nav-link {{ Request::is('schedules*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>Jadwal</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/grades" class="nav-link {{ Request::is('grades*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Nilai</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/admins" class="nav-link {{ Request::is('admins*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Admin</p>
                     </a>
                  </li>

                  @elseif(auth()->user()->role == 'siswa')

                  <li class="nav-item">
                     <a href="/student/dashboard"
                        class="nav-link {{ Request::is('student/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/student/nilai" class="nav-link {{ Request::is('student/nilai') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book-open"></i>
                        <p>Nilai</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/student/schedules"
                        class="nav-link {{ Request::is('student/schedules') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Jadwal</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/student/profile" class="nav-link {{ Request::is('student/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                     </a>
                  </li>

                  @else

                  <li class="nav-item">
                     <a href="/teacher/dashboard"
                        class="nav-link {{ Request::is('teacher/dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/teacher/profile" class="nav-link {{ Request::is('teacher/profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Profil</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/teacher/schedules"
                        class="nav-link {{ Request::is('teacher/schedules') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-table"></i>
                        <p>Jadwal</p>
                     </a>
                  </li>

                  <li class="nav-item">
                     <a href="/teacher/grades" class="nav-link {{ Request::is('teacher/grades*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Nilai</p>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a href="/teacher/homeroom-teacher"
                        class="nav-link {{ Request::is('teacher/homeroom-teacher*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>Wali Kelas</p>
                     </a>
                  </li>

                  @endif

                  <li class="nav-item">
                     <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                     </a>
                  </li>
                  {{-- <li class="nav-item has-treeview {{ Request::is('siswa','create') ? 'manu-open' : '' }}">
                  <a href="#" class="nav-link {{ Request::is('siswa','create') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-tachometer-alt"></i>
                     <p>
                        Master
                        <i class="right fas fa-angle-left"></i>
                     </p>
                  </a>
                  <ul class="nav nav-treeview" style=" {{ Request::is('siswa','create') ? 'display: block' : '' }}"">
              <li class=" nav-item">
                     <a href="/siswa" class="nav-link {{ Request::is('siswa') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Siswa</p>
                     </a>
                     </li>
                     <li class="nav-item">
                        <a href="/create" class="nav-link {{ Request::is('create') ? 'active' : '' }}">
                           <i class="far fa-circle nav-icon"></i>
                           <p>Dashboard v2</p>
                        </a>
                     </li>
                  </ul>
                  </li> --}}

                  <li class="nav-header">EXAMPLES</li>



               </ul>
            </nav>
            <!-- /.sidebar-menu -->
         </div>
         <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1>@yield('header')</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">@yield('header')</li>
                     </ol>
                  </div>
               </div>
            </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">

            <!-- Default box -->
            <div class="container-fluid">
               @yield('content')
            </div>

         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

      <footer class="main-footer">
         <strong>Copyright &copy; {{ date('Y') }} </strong> Benny Ds.
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
         <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
   </div>
   <!-- ./wrapper -->

   <!-- jQuery -->
   <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
   <!-- Bootstrap 4 -->
   <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
   <!-- AdminLTE App -->
   <script src="{{ asset('assets/dist/js/adminlte.min.js') }}"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
   <script src="{{ asset('assets/dist/js/demo.js') }}"></script>
   <script src="{{ asset('assets/plugins/datepicker/js/bootstrap-material-datetimepicker.js') }}"></script>

   <script
      src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
   </script>
   <script src="{{ asset('assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
   <script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
   <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.js"></script>
   <script src="{{ asset('assets/js/script.js') }}"></script>
   <script>
      @if (Session::has('status'))
         toastr.success("{{ session('status') }}", "Berhasil")   
      @endif
      @if (Session::has('error'))
         toastr.error("{{ session('error') }}", "Gagal")   
      @endif

      $('select').select2({
         theme: 'bootstrap4',
      });

      $('.jam').datetimepicker({
         format: 'HH:mm',
         stepping: 30,
         icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
         }
      })

      $('.date').datetimepicker({
         format: 'YYYY-MM-DD',
         locale: 'en',
         sideBySide: true,
         icons: {
            up: 'fas fa-chevron-up',
            down: 'fas fa-chevron-down',
            previous: 'fas fa-chevron-left',
            next: 'fas fa-chevron-right'
         }
      })
   </script>
   <script>
      $(document).ready(function() {
        
        $('.load').on('click', function() {
          var $this = $(this);
          var loadingText = '<span class="spinner-border spinner-border-sm"></span> Loading..';
          if ($(this).html() !== loadingText) {
            $this.data('original-text', $(this).html());
            $this.html(loadingText);
          }
          setTimeout(function() {
            $this.html($this.data('original-text'));
          }, Date.now()-timerStart);
            
         //  if( !$('#username').prop('validity').valid ){
         //    $this.html($this.data('original-text'));
         //  }
          
        });
      })
   </script>

   @yield('script')
</body>

</html>
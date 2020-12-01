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
   @yield('style')

   <!-- Google Font: Source Sans Pro -->
   <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
   <!-- Site wrapper -->
   <div class="wrapper">
      <!-- Navbar -->
      @include('layouts.navbar')
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      @include('layouts.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1>@yield('header')</h1>
                  </div>
                  {{-- <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">@yield('header')</li>
                     </ol>
                  </div> --}}
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
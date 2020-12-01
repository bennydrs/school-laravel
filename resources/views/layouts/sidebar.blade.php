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
                   /student/profile
                   @elseif(auth()->user()->role == 'admin')
                   /admin
                   @else
                   /teacher/profile
                   @endif" class="d-block">{{ auth()->user()->name }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
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
                    <a href="/informations" class="nav-link {{ Request::is('informations*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-info"></i>
                        <p>Pengumuman</p>
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
                        class="nav-link {{ Request::is('student/dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/student/grades" class="nav-link {{ Request::is('student/grades') ? 'active' : '' }}">
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
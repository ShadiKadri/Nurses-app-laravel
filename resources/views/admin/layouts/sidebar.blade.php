<div class="page-wrap">
    <div class="app-sidebar colored">
        <div class="sidebar-header">
            <a class="header-brand" href="{{ url('/dashboard') }}">
                <div class="logo-img">
                    <img src="images/logo.jpg" width="30px" height="30px">
                </div>
                <span class="text">Hospital</span>
            </a>

        </div>

        <div class="sidebar-content">
            <div class="nav-container">
                <nav id="main-menu-navigation" class="navigation-main">

                    <div class="nav-item active">
                        <a href="{{ url('dashboard') }}"><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></a>
                    </div>

                    @if (auth()->user()->role_id == 2)
                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Patients</span> <span
                                    class="badge badge-danger"></span></a>
                            <div class="submenu-content">
                                <a href="{{ route('patient.create') }}" class="menu-item">Create</a>
                                <a href="{{ route('patient.index') }}" class="menu-item">View</a>

                            </div>
                        </div>


                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Carings</span> <span
                                    class="badge badge-danger"></span></a>
                            <div class="submenu-content">
                                <a href="{{ route('caring.create') }}" class="menu-item">Create</a>
                                <a href="{{ route('caring.index') }}" class="menu-item">View</a>

                            </div>
                        </div>


                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>Caring Types</span> <span
                                    class="badge badge-danger"></span></a>
                            <div class="submenu-content">
                                <a href="{{ route('caring-types.create') }}" class="menu-item">Create</a>
                                <a href="{{ route('caring-types.index') }}" class="menu-item">View</a>

                            </div>
                        </div>

                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-file-text"></i><span>Nurse</span> <span
                                    class="badge badge-danger"></span></a>
                            <div class="submenu-content">
                                <a href="{{ route('nurse.create') }}" class="menu-item">Create</a>
                                <a href="{{ route('nurse.index') }}" class="menu-item">View</a>

                            </div>
                        </div>
                    @endif


                    <div class="nav-item has-sub">
                        <a href="javascript:void(0)"><i class="ik ik-monitor"></i><span>Patient Appointment</span>
                            <span class="badge badge-danger"></span></a>
                        <div class="submenu-content">
                            <a href="{{ route('patients') }}" class="menu-item">Today Appointment</a>
                            <a href="{{ route('all.appointments') }}" class="menu-item">All Time Appointment</a>

                        </div>
                    </div>

                    <div class="nav-item active">
                        <a onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"
                            href="{{ route('logout') }}"><i
                                class="ik ik-power dropdown-icon"></i><span>Logout</span></a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

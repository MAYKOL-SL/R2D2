<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menu</li>
            <!-- Optionally, you can add icons to the links -->
            <li><a href="{{ url('home') }}"><i class='fa fa-bank'></i> <span>Home</span></a></li>
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
            <li class="treeview">
                <a href="#"><i class='fa fa-user-plus'></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/users') }}">Usuarios</a></li>
                    <li><a href="{{ url('admin/roles') }}">Roles</a></li>

                </ul>
            </li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
            <li><a href="{{ url('calendario') }}"><i class='fa fa-calendar'></i> <span>Calendario</span></a></li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
            <li><a href="{{ url('consulta') }}"><i class='fa fa-calendar-plus-o''></i> <span>Introducir Fechas</span></a></li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador')|| Auth::user()->hasRole('Docente')|| Auth::user()->hasRole('Secretaria')|| Auth::user()->hasRole('Auxiliar'))
            <li><a href="{{ url('reservas') }}"><i class='fa fa-pencil-square-o'></i> <span>Reserva</span></a></li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
            <li><a href="{{ url('Formulario/form_cargar_calendario_academico') }}"><i class='fa fa-pencil'></i> <span>Cargar Calendario</span></a></li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador')|| Auth::user()->hasRole('Docente')|| Auth::user()->hasRole('Secretaria'))
            <li class="treeview">
                <a href="#"><i class='fa fa-tasks'></i> <span>Busquedas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ambiente')}}">Busqueda Por Ambiente</a></li>
                    <li><a href="{{ url('porHora') }}">Busqueda Por Hora</a></li>
                    <li><a href="{{ url('porCapacidad') }}">Busqueda Por Capacidad</a></li>
                </ul>
            </li>
            @endif
            @if(Auth::check() && Auth::user()->hasRole('Administrador'))
            <li class="treeview">
                <a href=""><i class='fa fa-building'></i> <span>Registrar Ambiente</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('CrearAmbiente')}}">Ambiente</a></li>
                    <li><a href="{{url('tiposambiente')}}">Tipos Ambiente</a></li>
                    <li><a href="{{url('complemento')}}">Complementos</a></li>
                </ul>
            </li>
            @endif

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

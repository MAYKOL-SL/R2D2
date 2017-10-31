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
            <li class="header">Munu</li>
            <!-- Optionally, you can add icons to the links -->

            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/users') }}">Usuarios</a></li>
                    <li><a href="{{ url('admin/roles') }}">Roles</a></li>

                </ul>
            </li>


            <li><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Home</span></a></li>

            <li><a href="{{ url('reserva') }}"><i class='fa fa-link'></i> <span>Reserva</span></a></li>

            <li><a href="{{ url('ReservaAmbiente') }}"><i class='fa fa-link'></i> <span>Registro Ambiente</span></a></li>

            <li><a href="{{ url('calendario') }}"><i class='fa fa-link'></i> <span>Ver Calendario</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Registrar Ambiente</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Ambiente</a></li>
                    <li><a href="{{url('complemento')}}">Complementos</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Tipos de Reservas</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ambiente')}}">Por Ambiente</a></li>
                    <li><a href="{{ url('consulta') }}">Por Capacidad</a></li>
                    <li><a href="{{ url('porHora') }}">Por Hora</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

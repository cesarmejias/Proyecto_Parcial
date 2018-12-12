  <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="{{route('users.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Usuarios</span></a></li>
        <li><a href="{{route('transactions.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Transacciones</span></a></li>
        <li><a href="{{route('categories.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Categorias</span></a></li>
        <li><a href="{{route('roles.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Roles</span></a></li>
        <li><a href="{{route('permissions.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Permisos</span></a></li>
        <li class="treeview">
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
      </ul>

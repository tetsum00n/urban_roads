{if isset(Session::get('autenticate'))}
<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="{$_layoutParams.route_img}user.png" width="50px" alt="User Image">
    <div>
      <p class="app-sidebar__user-nombre">{{Session::get('user_nombre')}}</p>
    </div>
  </div>
  <ul class="app-menu">
    <li><a class="app-menu__item" href="{$_layoutParams.root}home"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Pagina Principal</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-user-o"></i><span class="app-menu__label">Usuarios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item" href="{$_layoutParams.root}roles"><i class="icon fa fa-id-card-o"></i> Roles</a></li>
        <li><a class="treeview-item" href="{$_layoutParams.root}users" rel="noopener"><i class="icon fa fa-user-circle"></i>Usuarios</a></li>
      </ul>
    </li>
    <li>
    <a class="app-menu__item" href="{$_layoutParams.root}bicicletas_motor"><i class="app-menu__icon fa fa-motorcycle"></i><span class="app-menu__label">Bicicletas motorizadas</span></a></li>
    <li>
    <a class="app-menu__item" href="{$_layoutParams.root}scooters"><i class="app-menu__icon fa fa-motorcycle"></i><span class="app-menu__label">Scooters</span></a></li>
    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-text"></i><span class="app-menu__label">Arriendo</span><i class="treeview-indicator fa fa-angle-right"></i></a>
      <ul class="treeview-menu">
        <li><a class="treeview-item active" href="{$_layoutParams.root}arriendos"><i class="icon fa fa-file-o"></i> Solicitud de Arriendo</a></li>
        <li><a class="treeview-item" href="page-login.html"><i class="icon fa fa-check-square-o"></i> Devolución</a></li>
        <li><a class="treeview-item" href="page-lockscreen.html"><i class="icon fa fa-hourglass-end"></i> Prórroga</a></li>
        <li><a class="treeview-item" href="page-user.html"><i class="icon fa fa-exclamation-circle"></i> Pagar Retraso</a></li>
      </ul>
    </li>
    <li>
    <a class="app-menu__item" href="{$_layoutParams.root}comunas"><i class="app-menu__icon fa fa-fort-awesome"></i><span class="app-menu__label">Comunas</span></a></li>
  </ul>
</aside>
{/if}

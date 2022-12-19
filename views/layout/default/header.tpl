  <!-- Navbar-->
    <header class="app-header"><img class="row align-items-center" src="http://images.squarespace-cdn.com/content/v1/5712e736e707eb7f22b26946/cdba89c0-638a-4c51-9132-2608be66ae9f/LDC_BIKEMAP__HeaderLogo-01.png" width="100px" alt="User Image"><a class="app-header__logo" href="{$_layoutParams.root}index">Urban Roads</a>
    {if isset(Session::get('autenticate'))}
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    {/if}
    <!-- Navbar Right Menu-->
    {if isset(Session::get('autenticate'))}
    <ul class="app-nav">
        <li class="app-search">
            <input class="app-search__input" type="search" placeholder="Buscar">
            <button class="app-search__button"><i class="fa fa-search"></i></button>
        </li>
    {/if}
        <!-- User Menu-->
        {if isset(Session::get('autenticate'))}
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li><a class="dropdown-item" href="{$_layoutParams.root}users/edit/{{Session::get('user_id')}}"><i class="fa fa-cog fa-lg"></i> Editar Perfil</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}users/show/{{Session::get('user_id')}}"><i class="fa fa-user fa-lg"></i> Perfil</a></li>
            <li><a class="dropdown-item" href="{$_layoutParams.root}login/logout"><i class="fa fa-sign-out fa-lg"></i> Cerrar Sesión</a></li>
        </ul>
        </li>
        {/if}
    </ul>

</header>
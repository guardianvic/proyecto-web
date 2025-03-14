     <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar-1.png" alt="User Image">
        <div>
          <!--<p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombres']; ?></p>
          <p class="app-sidebar__user-designation"><?= $_SESSION['userData']['nombrerol']; ?></p>-->
        </div>
      </div>
      <ul class="app-menu">
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/dashboard">
            <i class="app-menu__icon bi bi-speedometer fs-4"></i>
            <span class="app-menu__label">Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon bi bi-people-fill fs-4"></i>
            <span class="app-menu__label"> Usuarios</span>
            <i class="treeview-indicator bi bi-chevron-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon bi bi-record-circle"></i> Usuarios</a></li>
            <li><a class="treeview-item" href="<?= base_url(); ?>/roles"><i class="icon bi bi-record-circle"></i> Roles</a></li>
            <li><a class="treeview-item" href="<?= base_url(); ?>/permisos"><i class="icon bi bi-record-circle"></i> Permisos</a></li>
          </ul>
        </li>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/clientes">
            <i class="app-menu__icon bi bi-person-vcard-fill fs-4"></i>
            <span class="app-menu__label"> Clientes</span>
          </a>
        </li>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/productos">
            <i class="app-menu__icon bi bi-archive-fill fs-4"></i>
            <span class="app-menu__label"> Productos</span>
          </a>
        </li>
        <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/pedidos">
            <i class="app-menu__icon bi bi-cart-fill fs-4"></i>
            <span class="app-menu__label"> Pedidos</span>
          </a>
        </li>
         <li>
          <a class="app-menu__item" href="<?= base_url(); ?>/logout">
            <i class="app-menu__icon bi bi-door-open-fill fs-4"></i>
            <span class="app-menu__label"> Cerrar Sesión</span>
          </a>
        </li>
      </ul>
    </aside>
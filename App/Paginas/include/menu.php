<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link" href="<?= $router->route('app.home'); ?>/" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Painel de Controle</span>
                    </a>
                </li>

                <li class="list-divider"></li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= $router->route('app.empresas'); ?>" aria-expanded="false">
                        <i data-feather="layers" class="feather-icon"></i>
                        <span class="hide-menu">Empresas</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>

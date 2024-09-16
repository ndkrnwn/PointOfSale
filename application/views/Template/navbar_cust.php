<nav id="fontstyle" class="main-header navbar navbar-expand-md navbar-light navbar-white border-bottom-1 ">
    <div class="navbar-cointaner">
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= site_url('home') ?>" class="nav-link text-md text-dark">Home</a>

                </li>
                <li class="nav-item" style="padding-left: 30px;">
                    <a href="" class="nav-link text-md text-dark">Contacts</a>
                </li>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item">
                    <a href="<?= site_url('transaction') ?>" class="nav-link" title="Transaction">
                        <i class="fas fa-shopping-cart fa-sm  text-md text-dark"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('logout'); ?>" class="nav-link button-logout" title="Logout">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-md text-dark"></i>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</nav>
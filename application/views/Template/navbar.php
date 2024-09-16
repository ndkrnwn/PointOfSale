<nav id="fontstyle" class="main-header navbar navbar-expand-sm navbar-light navbar-white border-bottom-1 ">
    <div class="navbar-cointaner">
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <?php if ($this->fungsi->user_login()->level == 'UL001') {  ?>
                <li class="nav-item">
                    <a href="<?= site_url('admin/dashboard') ?>" class="nav-link">Dashboard</a>
                </li>
                <?php } ?>
                <?php if ($this->fungsi->user_login()->level == 'UL001') {  ?>
                <li class="nav-item dropdown">
                    <a id="dropdownMasterdata" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Master Data</a>
                    <ul aria-labelledby="dropdownMasterdata" class="dropdown-menu border-0 shadow fontpoppins">
                        <li><a href="<?= site_url('admin/customer') ?>" <?= $this->uri->segment(2) == 'customer' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">
                                Customer</a></li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="parameterSubMenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?= $this->uri->segment(2) == 'parameter' ? 'class="dropdown-item 
                            dropdown-toggle nav-link active"' : '' ?> class="dropdown-item dropdown-toggle nav-link">Parameter</a>
                            <ul aria-labelledby="parameterSubMenu" class="dropdown-menu border-0 shadow fontpoppins">
                                <li><a href="<?= site_url('admin/parameter/add') ?>" <?= $this->uri->segment(3) == 'add' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">Add Parameter</a></li>
                                <li><a href="<?= site_url('admin/parameter/customercategory') ?>" <?= $this->uri->segment(3) == 'customercategory' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">Customer Category</a></li>
                                <li><a href="<?= site_url('admin/parameter/servicecategory') ?>" <?= $this->uri->segment(3) == 'servicecategory' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">Treatment Category</a></li>
                                <li><a href="<?= site_url('admin/parameter/userlevel') ?>" <?= $this->uri->segment(3) == 'userlevel' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">User Level</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu dropdown-hover">
                            <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?= $this->uri->segment(2) == 'product' ? 'class="dropdown-item 
                            dropdown-toggle nav-link active"' : '' ?> class="dropdown-item dropdown-toggle nav-link">Product</a>
                            <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow fontpoppins">
                                <li>
                                    <a href="<?= site_url('admin/product/product') ?>" <?= $this->uri->segment(3) == 'product' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">Product Item</a>
                                </li>

                                <li class="dropdown-submenu">
                                    <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" <?= $this->uri->segment(3) == 'stock_in' || $this->uri->segment(3) == 'stock_out' ? 'class="dropdown-item 
                            dropdown-toggle nav-link active"' : '' ?> class="dropdown-item dropdown-toggle nav-link">Stock Product</a>
                                    <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow fontpoppins">
                                        <li><a href="<?= site_url('admin/product/stock_in') ?>" <?= $this->uri->segment(3) == 'stock_in' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link" class="dropdown-item nav-link">Stock In</a></li>
                                        <li><a href="<?= site_url('admin/product/stock_out') ?>" <?= $this->uri->segment(3) == 'stock_out' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">Stock Out</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><a href="<?= site_url('admin/service') ?>" <?= $this->uri->segment(2) == 'service' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">
                                Treatment</a></li>

                        <li><a href="<?= site_url('admin/user') ?>" <?= $this->uri->segment(2) == 'user' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">User</a></li>
                    </ul>
                </li>
                <?php } else { ?>
                <li class="nav-item">
                        <a href="<?= site_url('admin/customer') ?>"class="nav-link">Customer</a>
                </li>
                <?php } ?>
                <li class="nav-item dropdown">
                    <a id="dropdownMasterdata" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Sales</a>
                    <ul aria-labelledby="dropdownMasterdata" class="dropdown-menu border-0 shadow fontpoppins">
                        <li><a href="<?= site_url('admin/sales/transaction') ?>" <?= $this->uri->segment(3) == 'transaction' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">
                                Transaction</a></li>

                        <li><a href="<?= site_url('admin/sales/report_sales') ?>" <?= $this->uri->segment(3) == 'report_sales' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">
                                List Transaction</a></li>
                    </ul>
                </li>
                <?php if ($this->fungsi->user_login()->level == 'UL001') {  ?>
                <li class="nav-item">
                    <a href="<?= site_url('admin/report') ?>" class="nav-link">Report</a>
                </li>
                <?php } ?>
                <?php if ($this->fungsi->user_login()->level == 'UL001') {  ?>
                <li class="nav-item dropdown">
                    <a id="dropdownMasterdata" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Tools</a>
                    <ul aria-labelledby="dropdownMasterdata" class="dropdown-menu border-0 shadow fontpoppins">
                        <li><a href="<?= site_url('admin/tool/broadcast') ?>" <?= $this->uri->segment(3) == 'broadcast' ? 'class="dropdown-item nav-link active"' : '' ?> class="dropdown-item nav-link">
                                Broadcast Mail</a></li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        <span class="mr-2 d-none d-lg-inline text-info text-sm">Hello, <b> &nbsp;<?= $this->session->userdata('ses_name') ?></b></span>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in fontpoppins" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="<?= site_url('admin/user/edit_password/' . $this->session->userdata('ses_id')); ?>">
                            <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                            Change Password
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= site_url('admin/auth/logout'); ?>" class="dropdown-item button-logout">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
        </div>

    </div>
</nav>
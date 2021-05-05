        <div class="wrapper">
            <!-- ========== Left Sidebar Start ========== -->
            <div class="leftside-menu">
    
                <!-- LOGO -->
                <a href="<?=base_url()?>" class="logo text-center logo-light">
                    <span class="logo-lg">
                        <!-- <h3 class="c-white">Herbal House</h3> -->
                        <img src="<?=base_url()?>assets/images/herbal-house-logo.png" alt="" height="64">
                    </span>
                    <span class="logo-sm">
                        <!-- <h3 class="c-white">Herbal House</h3> -->
                        <img src="<?=base_url()?>assets/images/favicon.png" alt="" height="16">
                    </span>
                </a>

                <!-- LOGO -->
                <a href="<?=base_url()?>" class="logo text-center logo-dark">
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="16">
                    </span>
                    <span class="logo-sm">
                        <img src="assets/images/logo_sm_dark.png" alt="" height="16">
                    </span>
                </a>
    
                <div class="h-100" id="leftside-menu-container" data-simplebar>

                    <!--- Sidemenu -->
                    <ul class="side-nav">

                        <li class="side-nav-title side-nav-item">Navigation</li>

                        <li class="side-nav-item">
                            <a href="<?=base_url()?>account" class="side-nav-link">
                                <i class="uil-home-alt"></i>
                                <span> Dashboards </span>
                            </a>
                        </li>

                        <?php if ($this->session->user_type == 'admin'){ ?>

                        <li class="side-nav-item">
                            <a href="<?=base_url()?>ledger" class="side-nav-link">
                                <i class="uil-layer-group "></i>
                                <span> Ledger </span>
                            </a>
                        </li>

                        <li class="side-nav-item">
                            <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                                <i class="uil-store"></i>
                                <span> Ecommerce </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarEcommerce">
                                <ul class="side-nav-second-level">
                                    <li>
                                        <a href="<?=base_url('product/code-list')?>">Product Code List</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('ecom/products')?>">Products</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('ecom/products-category')?>">Products Category</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('ecom/orders')?>">Orders</a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('ecom/customers')?>">Customers</a>
                                    </li>
                                    <li>
                                        <a href="apps-ecommerce-sellers.html">Sellers</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url()?>members" class="side-nav-link">
                                <i class=" uil-users-alt "></i>
                                <span> Member List </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('code-list')?>" class="side-nav-link">
                                <i class="uil-database "></i>
                                <span> Activation Code List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url()?>settings/maintenance" class="side-nav-link">
                                <i class="uil-cog"></i>
                                <span> Maintenance </span>
                            </a>
                        </li>
                       
                        
                        <?php } else if ($this->session->user_type == 'member'){ ?>
                        <li class="side-nav-item">
                            <a href="<?=base_url('member/direct-invites')?>" class="side-nav-link">
                                <i class="uil-users-alt  "></i>
                                <span> Direct List</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('member/binary')?>" class="side-nav-link">
                                <i class="uil-game-structure "></i>
                                <span> Binary Tree </span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('member/codes')?>" class="side-nav-link">
                                <i class="uil-database "></i>
                                <span> My Codes</span>
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="<?=base_url('member/ewallet')?>" class="side-nav-link">
                                <i class="uil-wallet "></i>
                                <span> E-wallet</span>
                            </a>
                        </li>

                        <?php } ?>
                    </ul>

                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
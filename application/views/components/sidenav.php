<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="<?php echo base_url() ?>">
                <h3 class="pt-2">Prediksi Bolos</h3>
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $this->uri->segment(1) == ""
                                                || $this->uri->segment(1) == "training"
                                                || $this->uri->segment(1) == "testing" ? 'active' : '' ?>" href="#navbar-forms" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-forms">
                            <i class="ni ni-single-copy-04 text-pink"></i>
                            <span class="nav-link-text">Dataset</span>
                        </a>
                        <div class="collapse show" id="navbar-forms">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="<?php echo base_url() ?>" class="nav-link <?php echo $this->uri->segment(1) == ""
                                                                                            || $this->uri->segment(1) == "training" ? 'active' : '' ?>">Data Training</a>
                                </li>
                                <li class=" nav-item">
                                    <a href="<?php echo base_url('testing') ?>" class="nav-link <?php echo $this->uri->segment(1) == "testing" ? 'active' : '' ?>">Data Testing</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
            </div>
        </div>
    </div>
</nav>
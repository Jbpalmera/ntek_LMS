<!--Nav Start-->
<nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <button data-trigger="navbar_main" class="d-xl-none btn btn-primary rounded-pill p-1 pt-0" type="button">
            <svg class="icon-20" width="20px"  viewBox="0 0 24 24">
            <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
        </svg>
        </button>
        <a href="" class="navbar-brand">
            <!--Logo start-->
            <img class="logo" src="<?php echo base_url('/assets/assets/images/LMS.png') ?>" alt="">
            <!--logo End-->        
            <h4 class="logo-title">Library Management</h4>
        </a>
        <!-- Horizontal Menu Start -->
        <nav id="navbar_main" class="mobile-offcanvas nav navbar navbar-expand-xl hover-nav horizontal-nav mx-md-auto">
        <div class="container-fluid">
            <div class="offcanvas-header px-0">
                <div class="navbar-brand ms-3">
                    
                    <!--Logo start-->
                    <div class="logo-main">
                        <div class="logo-normal">
                            <img class="logo" src="<?php echo base_url('/assets/assets/images/LMS.png') ?>" alt="">
                        </div>
                        <div class="logo-mini">
                            <img class="logo" src="<?php echo base_url('/assets/assets/images/LMS.png') ?>" alt="">
                        </div>
                    </div>
                    <!--logo End-->
                    <h4 class="logo-title">Library Management</h4>
                    
                </div>
                <button class="btn-close float-end"></button>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link " href="<?= base_url('userDash') ?>"> Dashboard </a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="<?= base_url('userBook') ?>"> Books </a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="<?= base_url('checkOut') ?>"> Check Out </a>
                </li>
                <li class="nav-item">
                <a class="nav-link " href="<?= base_url('userIssuedBook') ?>"> Issued Books </a>
                </li>
            </ul>
        </div>
        <!-- container-fluid.// -->
        </nav>
        <!-- Sidebar Menu End -->    
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
            <span class="navbar-toggler-bar bar1 mt-2"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item dropdown">
            <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?php echo base_url('assets/assets/images/avatars/01.png') ?>" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
                <div class="caption ms-3 d-none d-md-block">
                    <h6 class="mb-0 caption-title">Hi! <?php echo $studentInfo['fullName'] ?></h6>
                    <p class="mb-0 caption-sub-title">Library User</p>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="<?= base_url('userProfile') ?>">My Profile</a></li>
                <li><a class="dropdown-item" href="<?= base_url('userChangePass') ?>">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="<?= base_url('User_controller/logout') ?>">Logout</a></li>
            </ul>
            </li>
        </ul>
        </div>
    </div>
</nav>
<!--Nav End-->
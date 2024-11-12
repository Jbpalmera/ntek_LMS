<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    
    </div>
    <!-- loader END -->
      <div class="wrapper">
        <section class="login-content">
            <div class="row m-0 align-items-center bg-white vh-100">            
                <div class="col-md-6">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                            <div class="card-body">
                            <?= $this->session->flashdata('message'); ?>
                            <a href="../../dashboard/index.html" class="navbar-brand d-flex align-items-center mb-3">
                                <!--Logo start-->
                                <img class="logo" src="<?php echo base_url('/assets/assets/images/LMS.png') ?>" alt="">
                                <!--logo End-->
                                <h4 class="logo-title ms-3">Admin Login</h4>
                            </a>
                            <h2 class="mb-2 text-center">Sign In</h2>
                            <p class="text-center">Login as Library Administrator</p>
                                <form class="user" method="POST" action="<?= base_url('Auth/index'); ?>">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                            <label class="form-label">Username</label>
                                            <input class="form-control" type="text" id="username" name="username" aria-describedby="email" placeholder=" " required>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                            <labelclass="form-label">Password</labelclass=>
                                            <input type="password" class="form-control" id="password" name="password" aria-describedby="password" placeholder=" " required>
                                            </div>
                                            <div class="form-group">
                                                <label>Verification code:</label>
                                                <input type="text" name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />
                                                <img src="<?= base_url('auth/captcha'); ?>" alt="Captcha Image">
                                            </div>
                                        </div>
                                        <!-- <div class="col-lg-12 d-flex justify-content-end">
                                            <a href="recoverpw.html">Forgot Password?</a>
                                        </div> -->
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="login" class="btn btn-primary">Sign In</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sign-bg">
                    <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g opacity="0.05">
                        <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                        <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                        <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                        <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                        </g>
                    </svg>
                </div>
                </div>
                <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
                <img src="<?php echo base_url('assets/assets/images/auth/01.png') ?>" class="img-fluid gradient-main animated-scaleX" alt="images">
                </div>
            </div>
        </section>
      </div>
</body>
<body class="boxed-fancy">
    <div class="boxed-inner">
      <!-- loader Start -->
      <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body">
            </div>
        </div>      
      </div>
      <!-- loader END -->
      <span class="screen-darken"></span>
        <main class="main-content">
            <?php $this->load->view('Templates/userNavbar') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <?= $this->session->flashdata('message') ?> 
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Change Password</h4>
                                    <p class="mb-0">
                                        This section is for Changing the Password of the User
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                              <form role="form" method="post" onSubmit="return valid();" name="chngpwd">
                                 <div class="form-group">
                                    <label>Current Password</label>
                                    <input class="form-control" type="password" name="password" autocomplete="off" required  />
                                 </div>
                                 <div class="form-group">
                                    <label>Enter Password</label>
                                    <input class="form-control" type="password" name="newpassword" autocomplete="off" required  />
                                 </div>
                                 <div class="form-group">
                                    <label>Confirm Password </label>
                                    <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                                 </div>
                                 <button type="submit" name="change" class="btn btn-info">Change </button> 
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>
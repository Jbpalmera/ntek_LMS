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
            <?php $this->load->view('Templates/navbar') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Change Password</h4>
                                    <p class="mb-0">
                                        This section is for Updating the Admin's Password
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <?= $this->session->flashdata('message') ?>
                                <?php echo validation_errors('<p class="text-danger">', '</p>'); ?>
                                <?php echo form_open('admin/change_password'); ?>
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input class="form-control" type="password" name="current_password" autocomplete="off" required  />
                                    </div>
                                    <div class="form-group">
                                        <label>Enter New Password</label>
                                        <input class="form-control" type="password" name="new_password" autocomplete="off" required  />
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password </label>
                                        <input class="form-control"  type="password" name="confirm_password" autocomplete="off" required  />
                                    </div>
                                    <button type="submit" value="Change Password" class="btn btn-info">Change </button> 
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>
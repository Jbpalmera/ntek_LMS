    <div class="content-wrapper">
        <div class="container">
            <div class="row pad-botm">
                <div class="col-md-12">
                    <h4 class="header-line">ADMIN LOGIN FORM</h4>
                </div>
            </div>
            <!-- LOGIN PANEL START -->
            <?= $this->session->flashdata('message'); ?>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            LOGIN FORM
                        </div>
                        <div class="panel-body">
                            <form class="user" method="POST" action="<?= base_url('Auth/index'); ?>">
                                <div class="form-group">
                                    <label>Enter Username</label>
                                    <input class="form-control" type="text" id="username" name="username" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" id="password" name="password" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label>Verification code:</label>
                                    <input type="text" name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />
                                    <img src="<?= base_url('auth/captcha'); ?>" alt="Captcha Image">
                                </div>
                                <button type="submit" name="login" class="btn btn-info">LOGIN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js'); ?>"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
    <!-- CUSTOM SCRIPTS  -->
    <script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

    


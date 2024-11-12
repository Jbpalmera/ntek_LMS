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
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">User Profile</h4>
                                    <p class="mb-0">
                                        This section is the list of Personal Information of the User
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <form name="signup" method="post">
                                    <div class="form-group">
                                        <label>Student ID : </label>
                                        <?= $studentInfo['studentID'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Reg Date : </label>
                                        <?= $studentInfo['regDate'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Updation Date : </label>
                                        <?= $studentInfo['updationDate'] ?>
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Status : </label>
                                        <?php if($studentInfo['status'] == 1){ ?>
                                        <span style="color: green">Active</span>
                                        <?php } else { ?>
                                        <span style="color: red">Blocked</span>
                                        <?php }?>
                                    </div>
                                    <div class="form-group">
                                        <label>Enter Full Name</label>
                                        <input class="form-control" type="text" name="fullname" value="<?= $studentInfo['fullName'] ?>" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile Number :</label>
                                        <input class="form-control" type="text" name="mobileno" maxlength="11" value="<?= $studentInfo['mobileNumber'] ?>" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email" id="emailid" value="<?= $studentInfo['emailID'] ?>"  autocomplete="off" required readonly />
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary button" id="submit">Update Now </button>
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
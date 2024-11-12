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
                                    <h4 class="card-title mb-2">Register Student</h4>
                                    <p class="mb-0">
                                        This section is for adding new Student to library
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentname" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="phonenumber" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Membership<span style="color:red;">*</span></label>
                                    <select class="form-control" name="membership" required="required">
                                        <option value=""> Select Category</option>
                                        <?php foreach($membership as $member) : ?>
                                        <option value="<?= $member['categoryID'] ?>"><?= $member['membershipType'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="email" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Password<span style="color:red;">*</span></label>
                                    <input class="form-control" type="password" name="password"  required="required" autocomplete="off"  />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password<span style="color:red;">*</span></label>
                                    <input class="form-control" type="password" name="confirmpass" autocomplete="off"   required="required" />
                                </div>
                                <button type="submit" name="add" class="btn btn-info">Register</button>
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
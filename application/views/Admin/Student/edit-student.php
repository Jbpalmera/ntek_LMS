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
                                    <h4 class="card-title mb-2">Edit Student</h4>
                                    <p class="mb-0">
                                        This section is for Updating Student Information
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentID" autocomplete="off" value="<?= $student_info['studentID'] ?>" readonly/>
                                </div>
                                <div class="form-group">
                                    <label>Student Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="studentname" autocomplete="off" value="<?= $student_info['fullName'] ?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Mobile Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="phonenumber" autocomplete="off" value="<?= $student_info['mobileNumber'] ?>" required />
                                </div>
                                
                                <div class="form-group">
                                    <label>Email<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="email" autocomplete="off" value="<?= $student_info['emailID'] ?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Membership<span style="color:red;">*</span></label>
                                    <!-- <input class="form-control" type="text" name="studentID" autocomplete="off" value="<?= $student_info['membershipType'] ?>" readonly/><br> -->
                                    <select class="form-control" name="membership" required>
                    
                                        <?php foreach($membership_category as $category) : ?>
                                            <?php if($category['membershipType'] === $student_info['membershipType'])
                                            {?>
                                                <option selected value="<?= $category['id'] ?>"><?= $category['membershipType'] ?></option>
                                            <?php
                                            }
                                            else
                                            {?>
                                                <option value="<?= $category['id'] ?>"><?= $category['membershipType'] ?></option>
                                            <?php
                                            }
                                            ?>
                            
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            

                                <!-- <div class="form-group">
                                    <label>Confirm Password<span style="color:red;">*</span></label>
                                    <input class="form-control" type="password" name="confirmpass" autocomplete="off"   required="required" />
                                </div> -->
                                <button type="submit" name="add" class="btn btn-success">Update</button>
                            
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
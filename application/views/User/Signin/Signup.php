<body class=" " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body">
          </div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
               <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="<?php echo base_url('assets/assets/images/auth/05.png')  ?>" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
            <div class="col-md-6">               
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent auth-card shadow-none d-flex justify-content-center mb-0">
                        <div class="card-body">
                           
                           <h2 class="mb-2 text-center">Sign Up</h2>
                           <p class="text-center">Create your Account.</p>
                           <form name="signup" method="post">
                              <div class="form-group">
                                 <label>Enter Full Name</label>
                                 <input class="form-control" type="text" name="fullname" id="fullname" autocomplete="off" required />
                              </div>
                              <div class="form-group">
                                 <label>Mobile Number :</label>
                                 <input class="form-control" type="text" name="mobileno" id="username" maxlength="11" autocomplete="off" required />
                              </div>
                              <div class="form-group">
                                 <label>Membership :</label>
                                 <select class="form-control" name="membership" required="required">
                                    <option value=""> Select Category</option>
                                    <?php foreach($membership as $member) : ?>
                                    <option value="<?= $member['categoryID'] ?>"><?= $member['membershipType'] ?></option>
                                    <?php endforeach ?>
                                 </select>
                              </div>
                              <div class="form-group">
                                 <label>Enter Email</label>
                                 <input class="form-control" type="email" name="email" id="email" onBlur="checkAvailability()"  autocomplete="off" required  />
                                 <span id="user-availability-status" style="font-size:12px;"></span> 
                              </div>
                              <div class="form-group">
                                 <label>Enter Password</label>
                                 <input class="form-control" type="password" name="password" id="password" autocomplete="off" required  />
                              </div>
                              <div class="form-group">
                                 <label>Confirm Password </label>
                                 <input class="form-control"  type="password" name="confirmpassword" autocomplete="off" required  />
                              </div>
                              <div class="form-group">
                                 <label>Verification code : </label>
                                 <input type="text" name="vercode" maxlength="5" autocomplete="off" required style="width: 150px; height: 25px;" />
                                 <img src="<?= base_url('User_controller/captcha'); ?>" alt="Captcha Image">
                              </div>
                              <div class="d-flex justify-content-center mt-4">
                                 <button type="submit" name="signup" class="btn btn-info " id="submit">Register Now </button>
                              </div>
                              <div class="d-flex justify-content-center mt-3">
                                 <p class="mt-3 text-center">
                                       Want to Login? <a href="<?= base_url('userLogin') ?>">Login</a>
                                 </p>
                              </div>
                           </form>
                        </div>
                     </div>    
                  </div>
               </div>           
               <div class="sign-bg sign-bg-right">
                  <svg width="280" height="230" viewBox="0 0 421 359" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                        <rect x="-15.0845" y="154.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -15.0845 154.773)" fill="#3A57E8"/>
                        <rect x="149.47" y="319.328" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 149.47 319.328)" fill="#3A57E8"/>
                        <rect x="203.936" y="99.543" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 203.936 99.543)" fill="#3A57E8"/>
                        <rect x="204.316" y="-229.172" width="543" height="77.5714" rx="38.7857" transform="rotate(45 204.316 -229.172)" fill="#3A57E8"/>
                     </g>
                  </svg>
               </div>
            </div>   
         </div>
      </section>
      </div>
  </body>
<div class="content-wrapper">
         <div class="container">
            <div class="row pad-botm">
               <div class="col-md-12">
                  <h4 class="header-line">User Change Password</h4>
               </div>
            </div>
            <?= $this->session->flashdata('message') ?>
            <!--LOGIN PANEL START-->           
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
                  <div class="panel panel-info">
                     <div class="panel-heading">
                        Change Password
                     </div>
                     <div class="panel-body">
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
            <!---LOGIN PABNEL END-->            
         </div>
      </div>
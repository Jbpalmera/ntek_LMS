<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<div class="navbar navbar-inverse set-radius-zero" >
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand" >
         <img src="<?= base_url('assets/img/logo.png') ?>" />
         </a>
      </div>
     
      <div class="right-div">
         <a href="<?= base_url('User_controller/logout') ?>" class="btn btn-danger pull-right">LOG ME OUT</a>
      </div>

   </div>
</div>
<!-- LOGO HEADER END-->

<section class="menu-section">
   <div class="container">
      <div class="row ">
         <div class="col-md-12">
            <div class="navbar-collapse collapse ">
               <ul id="menu-top" class="nav navbar-nav navbar-right">
                  <li><a href="<?= base_url('User_controller/userDashboard') ?>" class="menu-top-active">DASHBOARD</a></li>
                  <li>
                     <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Account <i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('User_controller/profile') ?>">My Profile</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('User_controller/changePass') ?>">Change Password</a></li>
                     </ul>
                  </li>
                  <li><a href="<?= base_url('User_controller/issuedBooks') ?>">Issued Books</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>



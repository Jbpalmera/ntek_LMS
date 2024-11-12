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
         <a class="navbar-brand">
         <img src="<?= base_url('assets/img/logo.png') ?>" />
         </a>
      </div>
      <div class="right-div">
         <a href="<?= base_url('Auth/logout') ?>" class="btn btn-danger pull-right">LOG ME OUT</a>
      </div>
   </div>
</div>
<!-- LOGO HEADER END-->
<section class="menu-section">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <div class="navbar-collapse collapse">
               <ul id="menu-top" class="nav navbar-nav navbar-right">
                  <li><a href="<?= base_url('dashboard') ?>" class="menu-top-active">DASHBOARD</a></li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" id="ddlmenuItem" data-toggle="dropdown"> Categories <i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItem">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Category_controller/add_category') ?>">Add Category</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Category_controller/manage_categories') ?>">Manage Categories</a></li>
                     </ul>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" id="ddlmenuItemAuthors" data-toggle="dropdown"> Authors <i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItemAuthors">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Author_controller/add_author') ?>">Add Author</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Author_controller/manage_author') ?>">Manage Authors</a></li>
                     </ul>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" id="ddlmenuItemBooks" data-toggle="dropdown"> Books <i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItemBooks">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Book_controller/add_book') ?>">Add Book</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('Book_controller/manage_book') ?>">Manage Books</a></li>
                     </ul>
                  </li>
                  <li class="dropdown">
                     <a href="#" class="dropdown-toggle" id="ddlmenuItemIssueBooks" data-toggle="dropdown"> Issue Books <i class="fa fa-angle-down"></i></a>
                     <ul class="dropdown-menu" role="menu" aria-labelledby="ddlmenuItemIssueBooks">
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('BookDetails_controller/issue_book') ?>">Issue New Book</a></li>
                        <li role="presentation"><a role="menuitem" tabindex="-1" href="<?= base_url('BookDetails_controller/manage_issued_books') ?>">Manage Issued Books</a></li>
                     </ul>
                  </li>
                  <li><a href="<?= base_url('Student_controller/reg_student') ?>">Reg Students</a></li>
                  <li><a href="<?= base_url('Admin/change_password') ?>">Change Password</a></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</section>

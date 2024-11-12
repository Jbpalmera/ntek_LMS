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
                                    <h4 class="card-title mb-2">Add Category</h4>
                                    <p class="mb-0">
                                        This section is for adding new Category for the books
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                <form role="form" method="post" action="<?= base_url('Admin/add_category') ?>">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input class="form-control" type="text" name="category" autocomplete="off" required />
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="status" id="status" value="1" checked="checked">Active
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                            <input type="radio" name="status" id="status" value="0">Inactive
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" name="create" class="btn btn-info">Create </button>
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
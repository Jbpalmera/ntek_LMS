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
                                    <h4 class="card-title mb-2">Add Membership</h4>
                                    <p class="mb-0">
                                        This section is for adding new Membership Type 
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Membership Type</label>
                                    <input class="form-control" type="text" name="membership" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Category ID</label>
                                    <input class="form-control" type="text" name="category" autocomplete="off"  required />
                                </div>
                                <button type="submit" name="create" class="btn btn-info">Add </button>
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
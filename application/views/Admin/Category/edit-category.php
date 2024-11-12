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
                                    <h4 class="card-title mb-2">Edit Category</h4>
                                    <p class="mb-0">
                                        This section is for Updating Category of the books
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                              <?php foreach($category_info as $info) : ?>
                              <form role="form" method="post">
                                 <div class="form-group">
                                    <label>Category Name</label>
                                    <input class="form-control" type="text" name="category" value="<?= $info['categoryName'] ?>" required />
                                 </div>
                                 <div class="form-group">
                                    <label>Status</label>
                                    <?php 
                                    if($info['status'] == 1)
                                    {  ?>
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
                                    <?php }else{ ?>
                                    <div class="radio">
                                       <label>
                                       <input type="radio" name="status" id="status" value="0" checked="checked">Inactive
                                       </label>
                                    </div>
                                    <div class="radio">
                                       <label>
                                       <input type="radio" name="status" id="status" value="1">Active
                                       </label>
                                       </div
                                    </div>
                                    <?php } ?>
                                    <button type="submit" name="submit" class="btn btn-info">Update</button>
                              </form>
                              <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </main>
      <!-- Wrapper End-->
    </div>
</body>
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
                                    <h4 class="card-title mb-2">Edit Book</h4>
                                    <p class="mb-0">
                                        This section is for Updating Book Information
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                              <form role="form" method="post">
                                 <div class="form-group">

                                 </div>
                                 <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" value="<?php echo $info['bookName'] ?>" required />
                                 </div>
                                 <div class="form-group">
                                    <label> Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required="required">
                                       <!-- <option value=""></option> -->
                                       <?php foreach($category as $cat) : ?>
                                       <option value="<?= $cat['id'] ?>"><?= $cat['categoryName'] ?></option>
                                       <?php endforeach ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label> Author<span style="color:red;">*</span></label>
                                    <select class="form-control" name="author" required="required">
                                       <!-- <option value=""></option> -->
                                       <?php foreach($author as $authorName) : ?>
                                       <option value="<?= $authorName['id'] ?>"><?= $authorName['authorName'] ?></option>
                                       <?php endforeach ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label>Publication<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publication" value="<?php echo $info['publication'] ?>"  required="required" />
                                 </div>
                                 <div class="form-group">
                                    <label>Publisher<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publisher" value="<?php echo $info['publisher'] ?>"  required="required" />
                                 </div>
                                 <div class="form-group">
                                    <label>Accession Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="accessionNumber" value="<?php echo $info['accessionNumber'] ?>"  required="required" />
                                 </div>
                                 <div class="form-group">
                                    <label>Price<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="price" value="<?php echo $info['bookPrice'] ?>"   required="required" />
                                 </div>
                                 
                                 <button type="submit" name="update" class="btn btn-info">Update </button>
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
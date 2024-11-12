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
            <?php $this->load->view('Templates/Enrollment') ?>
            <div class="container-fluid content-inner pb-0">
                <div class="d-flex justify-content-center ">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between flex-wrap">
                                <div class="header-title">
                                    <h4 class="card-title mb-2">Enroll New Book</h4>
                                    <p class="mb-0">
                                        This section is for enrolling New Book in the Library 
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <?php if(validation_errors()): ?>
                                    <div class="alert alert-danger">
                                        <?= validation_errors(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="form-group">
                                    <label>Book Name<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="bookname" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label> Category<span style="color:red;">*</span></label>
                                    <select class="form-control" name="category" required="required">
                                        <option value=""> Select Category</option>
                                        <?php foreach($category as $cat) : ?>
                                        <option value="<?= $cat['id'] ?>"><?= $cat['categoryName'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Author<span style="color:red;">*</span></label>
                                    <select class="form-control" name="author" required="required">
                                        <option value=""> Select Author</option>
                                        <?php foreach($author as $authors) : ?>
                                        <option value="<?= $authors['id'] ?>"><?= $authors['authorName'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Accession Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="accessionNumber"  required="required" autocomplete="off"  />
                                </div>
                                <div class="form-group">
                                    <label>ISBN Number<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="isbn"  required="required" autocomplete="off"  />
                                    <p class="help-block">An ISBN is an International Standard Book Number. ISBN Must be unique</p>
                                </div>
                                <div class="form-group">
                                    <label>Publisher<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publisher" autocomplete="off"  required />
                                </div>
                                <div class="form-group">
                                    <label>Publication<span style="color:red;">*</span></label>
                                    <input class="form-control" type="text" name="publication" autocomplete="off"  required />
                                </div>
                                <button type="submit" name="create" class="btn btn-info">Enroll </button>
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
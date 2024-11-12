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
                                    <h4 class="card-title mb-2">Edit Issued Book</h4>
                                    <p class="mb-0">
                                        This section is for Updating Issued Book Information
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                            <form role="form" method="post">
                                <div class="form-group">
                                    <label>Student Name :</label>
                                    <?= $info['fullName'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Book Name :</label>
                                    <?= $info['bookName'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Accession Number</label>
                                    <?= $info['accessionNumber'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Book Issued Date :</label>
                                    <?= $info['issuesDate'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Book Returned Date :</label>
                                    <?= $info['returnDate'] ?>
                                </div>
                                <div class="form-group">
                                    <label>Fine :</label>
                                    <input class="form-control" type="text" name="fine" id="fine"  required />
                                </div>
                                <button type="submit" name="return" id="submit" class="btn btn-info">Return Book </button>
                                </div>
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